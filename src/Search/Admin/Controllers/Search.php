<?php 
namespace Search\Admin\Controllers;

class Search extends \Admin\Controllers\BaseAuth 
{
    public function index()
    {
        $q = $this->input->get( 'q', null, 'default' );
        
        try {
            $current_source = \Search\Models\Source::current();
            $paginated = \Search\Models\Source::paginate( $current_source, $q );
        }
        catch (\Exception $e) {
            $this->app->error(404, 'Search Type Not Found');
            return;        	
        }
        
        $this->app->set('current_source', $current_source );
        $this->app->set('paginated', $paginated );
        $this->app->set('q', $q );

        $this->app->set('meta.title', trim( 'Search ' . $current_source['title'] ) );

        echo $this->theme->render('Search/Admin/Views::search/index.php');
    
    }
}