<?php
namespace Search\Admin;

class Listener extends \Dsc\Singleton
{

    public function onSystemRebuildMenu($event)
    {
        if ($model = $event->getArgument('model'))
        {
            $root = $event->getArgument('root');
            $app = clone $model;
            
            $app->insert(array(
                'type' => 'admin.nav',
                'priority' => 70,
                'title' => 'Search',
                'icon' => 'fa fa-search',
                'is_root' => false,
                'tree' => $root,
                'base' => '/admin/search'
            ));
            
         
            $children = array(
            	array(
            		'title' => 'History',
            		'route' => './admin/search/history',
            		'icon' => 'fa fa-history'
            	),
                array(
                    'title' => 'Settings',
                    'route' => './admin/search/settings',
                    'icon' => 'fa fa-cogs'
                )
            );
            
            $app->addChildren($children, $root);
            
            \Dsc\System::instance()->addMessage('Search added its admin menu items.');
        }
    }
}