<?php

defined('ROOTPATH') OR exit ('Access Denied');

if($_SERVER['SERVER_NAME'] == 'localhost')
{
//    database config
    define('DBNAME', 'twitter_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define("ROOT", 'http://localhost/twitter/public');

} else {
//    database config
    define('DBNAME', 'mvc_db');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define("ROOT", 'https://www.yourwebsite.com');

}

define ('APP_NAME', 'My Website');
define ('APP_DESC', 'Best website on the planet');

// True means show errors
define('DEBUG', true);