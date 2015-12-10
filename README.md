# Something
### Install

pgsql, composer, bower must be installed 

```sh
$ git clone https://github.com/cejixo3/somethng.git
$ cd something
$ git checkout origin/develop
$ composer install
$ bower install
```
configure dsn: config/db.php:3
```sh
$ yii migrate
```
add write permissions to web/covers  directory

### Login
{your_domain}/site/login 
login: admin
password: admin
