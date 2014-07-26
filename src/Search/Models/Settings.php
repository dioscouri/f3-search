<?php 
namespace Search\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
    public $source = 'all';
    
    protected $__type = 'admin.settings';
    
    
    public function defaultSource()
    {	
    
    	return $this->fetch()->{'search.source'};	
    }
}