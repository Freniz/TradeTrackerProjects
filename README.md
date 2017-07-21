TradeTracker.com Assessment work


Here we can see two projects developed using Symfony and ZendFramework.

Intially the project was built using ZendFramework but later decided to implement in Symfony.

Following things have been followed to develop this project.

1) HTML5 based markup
2) Used AngularJs to make the interface interactive
3) Used Boostrap for responsive / adaptive layout
4) Used Symfony and ZendFramework for the back-end
5) No database have been used
6) Have limited to 32MB of memory. manually used in code ini_set("memory_limit","256M"); 

7) Have followed coding standards (PSR-2)
8) Have used PHPunit Test almost for all logic

9) Have used less and sass CSS pre-processor.

	* Less in Zend framwork 
	* Sass in Symfony

10) Have generated Docker Image in code repository.

	Followed this document - https://docs.docker.com/get-started/

	* docker pull abdulnizam/tradetracker:zendframework for zend
	* docker pull abdulnizam/tradetracker:symfony for symfony

	a) <a href="https://github.com/Freniz/TradeTrackerProjects/blob/integration/DockerFile/symfony/Dockerfile">Dockerfile-Symfony</a>

	b) <a href="https://github.com/Freniz/TradeTrackerProjects/blob/integration/DockerFile/zend/Dockerfile">Dockerfile-Zend</a>

11) Have used gulp to compile the CSS pre-processor
	Require:
		have used Node to install the following packages
			follow the document to install node - https://nodejs.org/en/
			
			* gulp - npm install --global gulp
			* gulp-concat - npm install --global gulp-concat
			* gulp-less - npm install --global gulp-less
			* gulp-sass - npm instal --global gulp-sass 


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
	* Boostrap - http://getbootstrap.com/components/
	* Symfony - https://symfony.com/doc/3.1/index.html
	* less - http://lesscss.org/
	* sass - http://sass-lang.com/guide
	* psr-2 - http://www.php-fig.org/psr/psr-2/






