<?php 
namespace Search\Admin\Controllers;

class History extends \Admin\Controllers\BaseAuth 
{
   
 	protected function getModel()
    {
        $model = new \Activity\Models\Actions;
        return $model;
    }
    
    public function index()
    {
        $model = $this->getModel();
        $state = $model->emptyState()->populateState()->setCondition('properties.app', 'search')->getState();
        $this->app->set('state', $state );
        
        $paginated = $model->paginate();
        $this->app->set('paginated', $paginated );
    
        $this->app->set('meta.title', 'Search | History');
        
        echo $this->theme->render('Search/Admin/Views::history/list.php');
    }

}