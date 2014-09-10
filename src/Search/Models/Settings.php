<?php 
namespace Search\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
    protected $__type = 'search.settings';

    public $default_site_type = "pages";
    
    public $default_admin_type = "users";
}