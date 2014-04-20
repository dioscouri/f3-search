<?php
namespace Search\Traits;

trait SearchItem
{
    /**
     * Must return a \Search\Models\Item
     * 
     * @return boolean|\Search\Models\Item
     */
    abstract public function toSearchItem();
}