<?php 
namespace Search\Models;

class Item extends \Dsc\Models 
{
    public $url;
    public $title;
    public $subtitle;
    public $image;
    public $summary;
    public $datetime;
    public $action = 'View';
}