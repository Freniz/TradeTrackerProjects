<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }

    public function listAction()
    {
        $url = $this->_request->getParam('url');
        // $url = 'http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10';
        $results = new Tracker_XMLRenderer($url);
        $timeResults = $results->parseAndRender();
        $return_results = '<button type="button" class="btn btn-success btn-lg processtime">Processing Time : '.$timeResults.'</button>';
        echo $return_results;
    }
}
