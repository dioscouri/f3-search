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
            
            \Shop\Models\Activities::track('Performed Search', array(
                'Search Term' => $q,
                'Search Source' => $current_source['title'],
                'page_number' => $paginated->current_page
            ));
                        
        }
        catch (\Exception $e) {
            $this->app->error(404, 'Search Type Not Found');
            return;        	
        }
        
        $this->app->set('current_source', $current_source );
        $this->app->set('paginated', $paginated );
        $this->app->set('q', $q );

        $this->app->set('meta.title', trim( 'Search ' . $current_source['title'] ) );

        echo $this->theme->render('Search/Site/Views::search/index.php');
    
    }
}