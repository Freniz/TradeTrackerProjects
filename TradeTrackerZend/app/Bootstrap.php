<?php
require_once 'Zend/Loader/Autoloader.php';

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoloader()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('Tracker_');
        return $autoloader;
    }

    protected function _initRoutes()
    {
        $this->bootstrap('FrontController');
        $frontController = Zend_Controller_Front::getInstance();
        $router = $router = $frontController->getRouter(); // returns a rewrite router by default
        $router->addRoute(
            'TradeTracker',
            new Zend_Controller_Router_Route(
                ':action',
                                             array(    'module' => 'defaut',
                                                     'controller' => 'index'
                                                     )
            )
        );
    }

    protected function _initPlugins()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $front->registerPlugin(new Tracker_Core());
    }
}
