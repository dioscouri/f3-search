<?php 
namespace Search\Site\Controllers;

class Search extends \Dsc\Controller 
{
    public function index()
    {
        $q = $this->input->get( 'q', null, 'default' );
        
        try {
            $current_source = \Search\Models\Source::current();
            $paginated = \Search\Models\Source::paginate( $current_source, $q );
            
            \Dsc\Activities::track('Performed Search', array(
                'Search Term' => $q,
                'Search Source' => $current_source['title'],
                'page_number' => $paginated->current_page,
                'app' => 'search'
            ));
                        
        }
        catch (\Exception $e) 
        {
            \Dsc\System::addMessage($e->getMessage(), 'error');
            $current_source = array(
                'id' => 'invalid',
                'title' => ''
            );
            $paginated = null;
        }
        
        $this->app->set('current_source', $current_source );
        $this->app->set('paginated', $paginated );
        $this->app->set('q', $q );

        $this->app->set('meta.title', trim( 'Search ' . $current_source['title'] ) );

        echo $this->theme->render('Search/Site/Views::search/index.php');
    
    }
}