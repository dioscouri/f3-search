<?php
namespace Search\Admin;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Searches\Admin\Controllers',
            'url_prefix' => '/admin/searches' 
        ) );
        
        $this->addSettingsRoutes();
        $this->addCrudGroup( 'Searches', 'Search' );
    }
}