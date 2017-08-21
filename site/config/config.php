<?php

$index = dirname(__DIR__);
include_once($index.'/../config/custom-config.php');

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', $custom_config["kirby_license"]);

/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/

c::set('debug', true);


c::set('languages', array(
  array(
    'code'    => 'de',
    'name'    => 'Deutsch',
    'default' => true,
    'locale'  => 'de_DE',
    'url'     => '/de',
  ),
));
c::set('language.detect', true);

/*
---------------------------------------
Minify output
---------------------------------------
*/
c::set('MinifyHTML', $custom_config["compress_html"]);

/*
---------------------------------------
Cache Dir
---------------------------------------
*/
c::set('cachedir', $custom_config["cachedir"]);
