== MediaWiki for Kol Zchut ==

= Installation: =

* Sign up for Heroku
* Install Heroku Toolbelt for your machine
* Run:

```
git clone https://github.com/etsursalesforce/kolzchut.git
cd kolzchut
heroku create
git push heroku master
heroku config:set DATABASE_URL=mysql://USER:PASSWORD@SERVER:PORT/SCHEMA
```

Enjoy!
:-)

