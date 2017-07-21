FROM php:7.0-apache
COPY TradeTrackerSymfony/ /var/www/html/
RUN chmod -R 777 /var/www/html/
RUN a2enmod rewrite
EXPOSE 8002

RUN curl -O https://phar.phpunit.de/phpunit-3.7.38.phar
RUN chmod +x phpunit-3.7.38.phar
RUN mv phpunit-3.7.38.phar /usr/local/bin/phpunit
RUN phpunit --version
RUN cd /var/www/html/
RUN phpunit -c . tests/