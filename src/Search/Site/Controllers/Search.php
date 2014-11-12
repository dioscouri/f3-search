<?php

namespace Search\Site\Controllers;

class Search extends \Dsc\Controller {
	/*
	 * Maps to Correct Search Method
	 * 
	 */
	public function index() 

	{
		$filter = $this->input->get ( 'filter', '', 'array' );
		$source = \Search\Factory::defaultSource();
		if (empty ( $filter ) && $source == 'all') {
			$this->allSearch ();
		} else {
			$this->filteredSearch ();
		}
	}
	
	/*
	 * Searches All sources get two results per section
	 * 
	 * TODO maybe the number of results is configurable in settings?
	*/
	protected function allSearch() {
	
		$q = $this->input->get ( 'q', null, 'default' );
		
		try {
			
			$q = trim($this->input->get ( 'q', null, 'default' ));
			$sources = \Search\Factory::sources ();
			
			$results = array ();
			foreach ( $sources as $key => $source ) {
				$paginated = \Search\Models\Source::paginate ( $source, $q );
				if (! empty ( $paginated->items )) {
					$results [$source ['title']] = array_slice ( $paginated->items, 0, 2 );
				}
			}
			
			\Dsc\Activities::track ( 'Performed Search', array (
					'Search Term' => $q,
					'Search Source' => 'All',
					'page_number' => '1',
					'app' => 'search' 
			) );
			
		} catch ( \Exception $e ) {
			\Dsc\System::addMessage ( $e->getMessage (), 'error' );
			$current_source = array (
					'id' => 'invalid',
					'title' => '' 
			);
			$paginated = null;
		}
		
		$this->app->set ( 'current_source', 'all' );
		$this->app->set ( 'results', $results );
		$this->app->set ( 'q', $q );
		
		$this->app->set ( 'meta.title', trim ( 'Search ' . 'All' ) );
		
		echo $this->theme->render ( 'Search/Site/Views::search/all.php' );
	}
	
	/*
	 * Gets paginated results from a source
	*
	* 
	*/
	protected function filteredSearch() {
		$q = trim($this->input->get ( 'q', null, 'default' ));
		
		try {
			
			$current_source = \Search\Models\Source::current ();
			$paginated = \Search\Models\Source::paginate ( $current_source, $q );
			
			\Dsc\Activities::track ( 'Performed Search', array (
					'Search Term' => $q,
					'Search Source' => $current_source ['title'],
					'page_number' => $paginated->current_page,
					'app' => 'search' 
			) );
		} catch ( \Exception $e ) {
			\Dsc\System::addMessage ( $e->getMessage (), 'error' );
			$current_source = array (
					'id' => 'invalid',
					'title' => '' 
			);
			$paginated = null;
		}
		
		$this->app->set ( 'current_source', $current_source );
		$this->app->set ( 'paginated', $paginated );
		$this->app->set ( 'q', $q );
		
		$this->app->set ( 'meta.title', trim ( 'Search ' . $current_source ['title'] ) );
		
		echo $this->theme->render ( 'Search/Site/Views::search/index.php' );
	}
}