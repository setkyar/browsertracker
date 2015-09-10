<?php
    
// Display Errors On
ini_set('display_errors', 'On');

$autoload = __DIR__.'/vendor/autoload.php';

if ( ! file_exists($autoload))
{
  exit("Need to run \"composer install\"!");
}

require $autoload;

use SetKyar\Tracker\Tracker;

//What you want to use functions goes here!

$browser = Tracker::getBrowserInfo();

var_dump($browser);