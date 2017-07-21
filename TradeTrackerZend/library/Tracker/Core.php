<?php 

class Tracker_Core extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        //setting up default path
        $frontController = Zend_Controller_Front::getInstance();
        $mvcInstance = Zend_Layout::getMvcInstance();
        if (!$mvcInstance) {
            Zend_Layout::startMvc();
            $mvcInstance = Zend_Layout::getMvcInstance();
        }
        
        $mvcInstance->setLayoutPath(APPLICATION_PATH.'/layouts/');
        
        $view = $mvcInstance->getView();
        $view->baseURL   = 'http://' . $_SERVER['HTTP_HOST'] . $frontController->getBaseUrl()."/";
    }
}
