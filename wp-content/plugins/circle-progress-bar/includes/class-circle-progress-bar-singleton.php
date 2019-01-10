<?php
if ( !class_exists('Primped_Base_Singleton') ):
    abstract class Primped_Base_Singleton {
    /**
     * Parsed options for module
     *
     * @var array
     */
    protected $options;
    /**
     * List of default options for module
     *
     * @var array
     */
    static protected $default_options = array();
    /**
     * Collection of modules objects
     *
     * @var array
     */
    static private $instances;
    static public function get_instance($options =array()) {
        $class = get_called_class();
        if ( !isset(self::$instances[$class]) ) {
            if( !is_array($options) || !is_array($class::$default_options) ) {
                throw new InvalidArgumentException('Module options have to be an Array.');
            }
            self::$instances[$class] = new $class($options);
        }
        return self::$instances[$class];
    }
    /**
     * Protected constructor
     * @param   array
     */
    protected function __construct($options =array()) {
        $this->options = $this->parseOptions($options);
    }
    /**
     * Parses options array for module
     * @param   array
     * @return  array
     */
    protected function parseOptions($options) {
        return $options;
    }
    final private function __clone() { }
}
endif;