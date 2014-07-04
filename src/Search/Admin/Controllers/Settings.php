<?php 
namespace Search\Admin\Controllers;

class Settings extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\Settings;
	
	protected $layout_link = 'Search/Admin/Views::settings/default.php';
	protected $settings_route = '/admin/search/settings';
    
    protected function getModel()
    {
        $model = new \Search\Models\Settings;
        return $model;
    }
}