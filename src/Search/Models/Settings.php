<?php 
namespace Search\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
    public $source = 'all';
    
    protected $__type = 'search.settings';
}