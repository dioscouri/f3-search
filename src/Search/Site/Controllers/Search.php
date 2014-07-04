<?php 
namespace Search\Site\Controllers;

class Search extends \Dsc\Controller 
{
    public function index()
    {	
    	
    	$filter =  $this->input->get('filter','','array');
    	$settings = \Search\Models\Settings::fetch();
    	if(empty($filter) && $settings->{'source'} == 'all'){
    		$this->allSearch();
    	} else {
    		$this->filteredSearch();
    	}

    }
    
    protected function allSearch() {
    	$q = $this->input->get( 'q', null, 'default' );
    	$sources = \Search\Factory::sources();
    	
    	$results = array();
    	foreach($sources as $key => $source) {
    		$paginated = \Search\Models\Source::paginate( $source, $q );
    		if(!empty($paginated->items)) {
    			$results[$source['title']] = array_slice($paginated->items,0,2);
    		}
    	}
    	
    	$this->app->set('current_source', 'all' );
    	$this->app->set('results', $results );
    	$this->app->set('q', $q );
    	echo $this->theme->render('Search/Site/Views::search/all.php');
    	
    }
    
    protected function filteredSearch() {
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
    	 
    	echo $this->theme->render('Search/Site/Views::search/index.php');
    	 
    }
    
    
}