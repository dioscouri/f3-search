<?php
namespace Search\Traits;

trait SearchItem
{
    /**
     * Must return a \Search\Models\Item
     * 
     * @return boolean|\Search\Models\Item
     */
    public function toSearchItem() 
    {
        $item = new \Search\Models\Item( $this->cast() );
        
        return $item;
    }
    
    /**
     * Must return a \Search\Models\Item
     *
     * @return boolean|\Search\Models\Item
     */
    public function toAdminSearchItem()
    {
        $item = new \Search\Models\Item( $this->cast() );
    
        return $item;
    }    
}