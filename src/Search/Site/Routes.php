<?php
namespace Search\Site;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Search\Site\Controllers',
            'url_prefix' => '/search' 
        ) );
        
        $this->add( '', 'GET', array(
            'controller' => 'Search',
            'action' => 'index' 
        ) );
        
        $this->add( '', 'POST', array(
            'controller' => 'Search',
            'action' => 'submit'
        ) );
        
        $this->add( '/@keywords', 'GET', array(
            'controller' => 'Search',
            'action' => 'index'
        ) );
        
        $this->add( '/@keywords/page/@page', 'GET', array(
            'controller' => 'Search',
            'action' => 'index'
        ) );

    }
}