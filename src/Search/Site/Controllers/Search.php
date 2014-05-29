<?php 
namespace Search\Site\Controllers;

class Search extends \Dsc\Controller 
{
    public function index()
    {
        $f3 = \Base::instance();
        $q = $this->input->get( 'q', null, 'default' );
                
        // Get the default source
        $default_source = \Search\Factory::defaultSource();
         
        // Get the current selected source (use the state), fallback = default
        $current_source = (new \Search\Models\Source)->populateState()->getState('filter.search', $default_source); 
        
        // find the source 
        if ($source_exists = \Search\Factory::source($current_source))
        {
        	$class = $source_exists['class'];
        }
        elseif ($source_exists = \Search\Factory::source($default_source))
        {
            $class = $source_exists['class'];
        }
        
        if (empty($class) || !class_exists($class)) 
        {
        	// Trigger a 404 error
        	$f3->error(404, 'Search Type Not Found');
        	return;
        }
        
        \Base::instance()->set('current_source', $source_exists );
        
        // Use the source to make the query
        $source = new $class;
        $state = $source->setState('is.search', true)->populateState()->setState('filter.keyword', $q)->getState();
        \Base::instance()->set('state', $state );
        
        $paginated = $source->paginate();
        \Base::instance()->set('paginated', $paginated );
        
        \Base::instance()->set('q', $q );

        // report term to kickmetrics, if integration  required
        $settings = \Admin\Models\Settings::fetch();
        if( class_exists( '\KM' ) && $settings->enabledIntegration('kissmetrics')){
        	\KM::init( $settings->{'integration.kissmetrics.key'} );
        	$data = array("Search Terms" => $q);
        	 
        	$identity = \Dsc\System::instance()->get('auth')->getIdentity();
        	if( !empty( $identity->email ) ) {
        		\KM::identify( $identity->email );
        	}
        	$data['Page'] = (int)\Dsc\Pagination::findCurrentPage();
        	$data['Source'] = $current_source;
        	\KM::record("Site Search", $data );
        }

        $this->app->set('meta.title', trim( 'Search ' . $source_exists['title'] ) );
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->renderTheme('Search/Site/Views::search/index.php');
    
    }
}