<?php 
namespace Search;

class Factory extends \Dsc\Singleton 
{
    /**
     * 
     * @return string
     */
    public static function defaultSource()
    {
        $global_app_name = \Base::instance()->get('APP_NAME');
        switch($global_app_name) 
        {
            case "admin":
                $default = 'users'; // TODO Get this from the config
                break;
            default:
                $default = 'pages'; // TODO Get this from the config
                break;
        }
        
        
        return $default;
    }
    
    /**
     * Register a source with the system.
     * Normal usage is within a Listener or a bootstrap file
     *
     * @param unknown $name
     */
    public static function registerSource( \Search\Models\Source $new_source=null )
    {
        $sources = \Base::instance()->get('dsc.search.sources');
        if (empty($sources) || !is_array($sources))
        {
            $sources = array();
        }
    
        if (empty($new_source))
        {
            return $sources;
        }
    
        if (!array_key_exists($new_source->id, $sources))
        {
            // TODO check that the new_source->class exists AND that it has the toSearchItem() function
            $sources[$new_source->id] = $new_source->cast();
        }        
    
        \Base::instance()->set('dsc.search.sources', $sources);
    
        return $sources;
    }
    
    /**
     * Gets the sources registered with the system
     * 
     * @return unknown
     */
    public static function sources()
    {
        $sources = (array) \Base::instance()->get('dsc.search.sources');
        $sources = \Dsc\ArrayHelper::sortArrays($sources, 'priority');
    
        // TODO Put the default up top
        
        return $sources;
    }
    
    /**
     * Gets the source for the selected $id
     * 
     * @param unknown $id
     */
    public static function source($id) 
    {
        $sources = (array) \Base::instance()->get('dsc.search.sources');
        
        if (array_key_exists($id, $sources))
        {
            return $sources[$id];
        }
        
        return false;
    }
}