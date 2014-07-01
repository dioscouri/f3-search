<?php 
namespace Search\Models;

class Source extends \Dsc\Models 
{
    public $id;
    public $title;
    public $priority = 30;
    public $class;

    /**
     * Gets the current selected source
     * 
     * @throws \Exception
     * @return unknown
     */
    public static function current()
    {
        // Get the default source
        $default_source = \Search\Factory::defaultSource();
         
        // Get the current selected source (use the state), fallback = default
        $current_source = (new \Search\Models\Source)->populateState()->getState('filter.search', $default_source);
        
        // find the source
        if ($source_exists = \Search\Factory::source($current_source))
        {
            $class = $source_exists['class'];
        }
        elseif ($source_exists = \Search\Factory::source($default_source))
        {
            $class = $source_exists['class'];
        }
        
        if (empty($class) || !class_exists($class))
        {
            throw new \Exception('Search Type Not Found');
        }
        
        return $source_exists;
    }
    
    /**
     * Gets a paginated set back form a Source model for a query
     * 
     * @param unknown $source
     * @param unknown $q
     * @return unknown
     */
    public static function paginate( $source, $q )
    {
        $source = new $source['class'];
        $paginated = $source->setState('is.search', true)->populateState()->setState('filter.keyword', $q)->paginate();
        
        return $paginated;
    }
    
    /**
     * Gets the number of matches in a source model for a query
     * 
     * @param unknown $source
     * @param unknown $q
     * @return unknown
     */
    public static function count( $source, $q )
    {
        $source = new $source['class'];
        
        $source = $source->setState('is.search', true)->populateState()->setState('filter.keyword', $q);
        $total = $source->collection()->count( $source->conditions() );
    
        return $total;
    }
}