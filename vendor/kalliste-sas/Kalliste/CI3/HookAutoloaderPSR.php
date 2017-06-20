<?php

/**
 * @file : Kalliste/CI3/HookAutoloaderPSR.php
 * @see : http://codeigniter.com/user_guide/general/hooks.html
 * @see : https://codeigniter.com/user_guide/general/autoloader.html
 * @see : http://php.net/manual/en/function.spl-autoload-register.php
 * @see : http://www.php-fig.org/psr/psr-0
 * @see : https://getcomposer.org
 */
class Kalliste_CI3_HookAutoloaderPSR {

    /**
     *
     * @var array
     */
    protected $helperConfig;

    /**
     * Constructor
     */
    public function __construct() {
        /*
         * Sets the default directory to /vendor
         *
         */
        $helperConfig = array(
            'throw' => true,
            'prepend' => false,
            'directories' => array(
                dirname(dirname(dirname(__FILE__))
                ), /* the place you put your application specific PSR-0 autoloading classes (for example V1 or V2) */
            ),
        );

        $this->helperConfig = $helperConfig;
    }

    /**
     * @param type $classNameArg
     * @return boolean false or true
     */
    public function autoload($classNameArg) {

        $thisClass = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);

        foreach ($this->helperConfig['directories'] as $key => $baseDir) {
            if (substr($baseDir, -strlen($thisClass)) === $thisClass) {
                $baseDir = substr($baseDir, 0, -strlen($thisClass));
            }

            $className = ltrim($classNameArg, '\\');
            $fileName = rtrim($baseDir, ' ' . DIRECTORY_SEPARATOR);
            $namespace = '';
            if ($lastNamespacePos = strripos($className, '\\')) {
                $namespace = substr($className, 0, $lastNamespacePos);
                $className = substr($className, $lastNamespacePos + 1);
                $fileName .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
            }
            $fileName .= DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

            if (file_exists($fileName) && is_file($fileName)) {
                require $fileName;
                return true; // Class loaded
            }
        }
        return false; // Class not found
    }

    /**
     * Register PSR-0 autoloader
     * @see : http://php.net/manual/en/function.spl-autoload-register.php
     * @param type $throw
     * @param type $prepend
     * @return boolean
     */
    public function registerAutoloader($throw = true, $prepend = false) {
        $callable = array($this, "autoload");
        $return = spl_autoload_register($callable, $throw, $prepend);
        return $return;
    }

    /**
     * UnRegister PSR-0 autoloader
     * @see : http://php.net/manual/en/function.spl-autoload-unregister.php
     * @return boolean
     */
    public function unregisterAutoloader() {
        $callable = array($this, "autoload");
        $return = spl_autoload_unregister($callable);
        return $return;
    }

    /**
     * UnRegister then Register once again the PSR-0 autoloader for updating the '$prepend' flag
     * @see : http://php.net/manual/en/function.spl-autoload-register.php
     * @param type $throw
     * @param type $prepend
     * @return boolean
     */
    public function updateAutoloaderPrepend($throw = true, $prepend = false) {
        $this->unregisterAutoloader();
        return $this->registerAutoloader($throw, $prepend);
    }

    /**
     * This method is called automatically the Hook class in CodeIgniter
     * @param type $helperConfig
     * @return boolean
     */
    public function pre_system($helperConfig) {
        $this->helperConfig = $helperConfig;
        $return = $this->registerAutoloader($helperConfig['throw'], $helperConfig['prepend']);
        return $return;
    }

    /**
     *
     * @param type $helperConfig
     * @return $this
     */
    public function setConfig($helperConfig) {
        return $this->pre_system($helperConfig);
    }

    /**
     *
     * @return array
     */
    public function getConfig() {
        return $this->helperConfig;
    }
}
