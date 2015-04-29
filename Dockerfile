FROM php:5.6-apache

RUN apt-get update && apt-get install -y \
        php5-mysql \
    && docker-php-ext-install mysql

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

CMD echo -n "SetEnv DATABASE_URL $DATABASE_URL\nSetEnv SOLR_URL $SOLR_URL" | tee /etc/apache2/conf-enabled/dburl.conf && apache2-foreground
