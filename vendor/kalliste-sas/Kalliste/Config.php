<?php

/**
 * @file : Kalliste/Config.php
 * 
 */
class Kalliste_Config{

    /**
     * @var object : $this
     */
    static $firstInstance;

    /**
     * Constructor
     */
    protected function __construct() {
        if (self::$firstInstance === null) {
            self::$firstInstance = $this;
        }
       
    }

    /**
     * getInstance : returns the first instance of this class ( singleton design pattern)
     *
     * @return \$this
     */
    public static function getInstance() {
        if (self::$firstInstance == null) {
            self::$firstInstance = new self();
        }
        return self::$firstInstance;
    }

}
