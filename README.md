# TradeTracker.com Assessment work


Here we can see two projects developed using Symfony and ZendFramework.

Initially the project was built using ZendFramework but later decided to implement in Symfony.

Following things have been followed to develop this project.

1) HTML5 based markup
2) Used AngularJs to make the interface interactive
3) Used Bootstrap for responsive / adaptive layout
4) Used Symfony and ZendFramework for the back-end
5) No database have been used
6) Have limited to 32MB of memory. manually used in code ini_set("memory_limit","32M");
7) Displaying processed data in real-time 

8) Have followed coding standards (PSR-2)
9) Have used PHPunit Test almost for all logic

10) Have used less and sass CSS pre-processor.

	* Less in Zend framwork 
	* Sass in Symfony

11) Have generated Docker Image in code repository.

	Followed this document - https://docs.docker.com/get-started/

	Tags - <a href="https://hub.docker.com/r/abdulnizam/tradetracker/tags/" target="_blank">Abdulnizam-Docker-hub</a>

	Docker Projects - <a href="https://github.com/Freniz/TradeTrackerDockerProjects">Docker Projects</a>

		* docker pull abdulnizam/tradetracker:zendframework for zend
		* docker pull abdulnizam/tradetracker:symfony for symfony

		After pulldown in local : 

			docker run -p 8002:80 tradetracker:symfony (or) docker run -p 8002:80 tradetracker:zendframework

	a) <a href="https://github.com/Freniz/TradeTrackerProjects/blob/integration/DockerFiles/symfony/Dockerfile">Dockerfile-Symfony</a>

	b) <a href="https://github.com/Freniz/TradeTrackerProjects/blob/integration/DockerFiles/zend/Dockerfile">Dockerfile-Zend</a>

	To run the docker file 
	
		1) docker build -t tradetracker:{tag} . eg, docker build -t tradetracker:symfony .
		2) docker run -p {port}:80 tradetracker:{tag} eg, docker run -p 8002:80 tradetracker:symfony


12) Have used gulp to compile the CSS pre-processor
	Require:
		have used Node to install the following packages
			follow the document to install node - https://nodejs.org/en/
			
			* gulp - npm install --global gulp
			* gulp-concat - npm install --global gulp-concat
			* gulp-less - npm install --global gulp-less
			* gulp-sass - npm instal --global gulp-sass 


# The assignment

The assignment consists of two parts that should take about an equal amount of time (make sure that neither part gets neglected due to the other).

Part 1: User Interface

Create a page that will allow the user to submit a URL of a product feed. On submitting the form, the URL should be processed (as described in following section), and the results of that processing should be shown to the user.

Part 2: Feed Processing

The feed processing function should be able to handle very large feeds of a fixed format. For an example feed, the following test can be used:

Given URL LINK http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2

The feed is a few hundred megabytes large and contains thousands of products. The basic structure of the feed is described in appendix section.

Your code should:

	1. Fetch the contents of given URL without downloading entire file beforehand,
	2. Extract the following fields:
	a. productID
	b. name
	c. description
	d. price & currency
	e. category (all)
	f. productURL
	g. imageURL
	3. Render above extracted data in user-friendly way on front-end

#Problem Solving 

Here we are dealing with massive xml api by passing N limit to retrieving the data. 

Since it has almost 2+ GB to download the whole data, it hard to get the data by api.

Here we are using some method to access the xml data as much quicker.

	The simplest way would be to use XMLReader to get to each node, then use SimpleXML to access them.

	This way, we keep the memory usage low because we are treating one node at a time and we are still leverage SimpleXML's ease of use. 

	For Example:

		<pre>

			N can be 1, 10, 100, 1000, 10000 ...

			$url = 'http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=N';
			
			public function __construct($url)
		    {
		        $this->xmlrender = new XMLReader;
		        $this->xmlrender->open($url);
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
		    }
		</pre>

The following above method we have resolved the problems, for to access the massive XML data.


#PHPUNIT
---------

PHPUNIT has written for this App. please install phpunit to run the test.

If you dont have PHPUNIT on your machine, please find the link to install PHPUNIT

https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

Follow this document to install - https://phpunit.de/

To Run the test:

a) Symfony

	1) cd /TradeTrackerSymfony
	2) Run phpunit -c /tests

b) Zend

	1) cd /TradeTrackerZend/tests
	2) Run phpunit


Documents to read 
	 
	* AngularJs - https://docs.angularjs.org/tutorial/step_02
	* Bootstrap - http://getbootstrap.com/components/
	* Symfony - https://symfony.com/doc/3.1/index.html
	* less - http://lesscss.org/
	* sass - http://sass-lang.com/guide
	* psr-2 - http://www.php-fig.org/psr/psr-2/






