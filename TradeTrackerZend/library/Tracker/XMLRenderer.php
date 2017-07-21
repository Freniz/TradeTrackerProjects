<?php

class Tracker_XMLRenderer
{
    protected $xmlrender;
    public function __construct($url)
    {
        $this->timeFirst  = strtotime(date("Y-m-d H:i:s"));
        $this->xmlrender = new XMLReader;
        $this->xmlrender->open($url);
        //$this->xmlrender->open('http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&limit=10000');
    }

    public function parseAndRender()
    {
        $doc = new DOMDocument;
        
        while ($this->xmlrender->read() && $this->xmlrender->name !== 'product');
        
        while ($this->xmlrender->name === 'product') {
            $node = simplexml_import_dom($doc->importNode($this->xmlrender->expand(), true));
            echo $this->renderNode($node);
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
                            <h5>Id: <span class="text-info">'.$node->productID.'</span><h5>
                            <div class="trade-thumnail">
                                <a href="'.$this->urlDecode($node->productURL).'" target="_blank"><img class="trade-img" src="'.$node->imageURL.'" alt="trade-img"></a>
                            </div>
                            <div class="trade-content">
                                <h4><a href="'.$this->urlDecode($node->productURL).'" title="'.$node->name.'" target="_blank">'.$this->trimString($node->name, '30').'</a></h4>
                                <h5><span class="text-info">'.ucfirst($node->categories->category->attributes()->path).'</span><h5>
                                <p title="'.$node->description.'">'.$this->trimString($node->description, '70').'</p>
                                <a href="'.$this->urlDecode($node->productURL).'" target="_blank" class="more-btn">View More</a>
                            </div>
                            <span class="trade-currency">'.$this->currencySign($node->price, $node->price->attributes()->currency).'</span>
                        </div>
                 </div>';
    }

    public function trimString($string, $length, $dots = "...")
    {
        return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
    }

    public function currencySign($price, $sign)
    {
        // 'en_US', 'de_DE'
        $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
        return $fmt->formatCurrency((float)$price, $sign);
    }

    public function urlDecode($url)
    {
        return utf8_decode(urldecode($url));
    }
}
