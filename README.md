MediaWiki for Kol Zchut
=======================

Installation on Heroku
-----------------------

* Sign up for Heroku
* Install Heroku Toolbelt for your machine
* Run:

```
git clone https://github.com/etsursalesforce/kolzchut.git
cd kolzchut
heroku create
git push heroku master
heroku config:set DATABASE_URL=mysql://USER:PASSWORD@SERVER:PORT/SCHEMA
heroku config:set SOLR_URL=SERVER:PORT/solr/CORENAME
```


Installation Locally using Docker
----------------------------------

* Make sure you have docker installed locally (can use boot2docker)
* Run:

```
git clone https://github.com/etsursalesforce/kolzchut.git
cd kolzchut
docker build -t kolzchut .
docker run -d -p 8000:80 -e DATABASE_URL=mysql://USER:PASSWORD@SERVER:PORT/SCHEMA -e SOLR_URL=SERVER:PORT/solr/CORENAME kolzchut
```

and now the server is running in the docker host (localhost on linux, or in the VirtualBox machine if using boot2docker), and is accessible in port 8000.


Enjoy!
:-)

