<?php

namespace AppBundle\Model;

use XMLReader;
use DOMDocument;
use Symfony\Component\Intl\Intl;

class TrackerXMLRenderer
{
    protected $xmlrender;
    public function __construct($url)
    {
        $this->timeFirst  = strtotime(date("Y-m-d H:i:s"));
        $this->xmlrender = new XMLReader;
        $this->xmlrender->open($url);
        //$this->xmlrender->open('http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&limit=10000');
    }

    public function parseAndRender($flag = true)
    {
        $doc = new DOMDocument;
        
        while ($this->xmlrender->read() && $this->xmlrender->name !== 'product');
        
        while ($this->xmlrender->name === 'product') {
            $node = simplexml_import_dom($doc->importNode($this->xmlrender->expand(), true));
            
            if ($flag === true) {
                echo $this->renderNode($node);
            } else {
                return $this->renderNode($node);
            }
            $this->xmlrender->next('product');
        }
        $this->timeSecond = strtotime(date("Y-m-d H:i:s"));
        $differenceInSeconds = $this->timeSecond - $this->timeFirst;
        return $differenceInSeconds;
    }

    public function renderNode($node)
    {
        return '<div class="col-md-3 col-sm-4">
                   <div id="single-trade-item" class="single-trade-item">
                            <div class="trade-thumnail">
                                <a href="'.$this->urlDecode($node->productURL).'" target="_blank"><img class="trade-img" src="'.$node->imageURL.'" alt="trade-img"></a>
                            </div>
                            <div class="trade-content">
                                <h4><a href="'.$this->urlDecode($node->productURL).'" target="_blank">'.$this->trimString($node->name, '30').'</a></h4>
                                <h5><span class="text-info">'.ucfirst($node->categories->category->attributes()->path).'</span><h5>
                                <p>'.$this->trimString($node->description, '70').'</p>
                                <a href="'.$this->urlDecode($node->productURL).'" target="_blank" class="more-btn">View More</a>
                            </div>
                            <span class="trade-currency">'.$this->currencySign($node->price->attributes()->currency).' '.$node->price.'</span>
                        </div>
                 </div>';
    }

    public function trimString($string, $length, $dots = "...")
    {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }

    public function currencySign($sign)
    {
        $currency = Intl::getCurrencyBundle()->getCurrencySymbol((string)$sign);
        return $currency;
    }

    public function urlDecode($url)
    {
        return utf8_decode(urldecode($url));
    }
}
