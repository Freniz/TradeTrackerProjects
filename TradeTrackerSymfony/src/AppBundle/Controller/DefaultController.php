<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Model\TrackerXMLRenderer;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/list", name="listaction")
     */
    public function listAction(Request $request)
    {
        $url = $request->query->get('url');
        // $url = 'http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10';
        $results = new TrackerXMLRenderer($url);
        $timeResults = $results->parseAndRender();
        $return_results = '<button type="button" class="btn btn-success btn-lg processtime">Processing Time : '.$timeResults.'</button>';
        echo $return_results;

        return $this->render('default/list.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
