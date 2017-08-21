<?php
require "../lib/lessphp/lessc.inc.php";
$file = 'style';
$path = '../css/';

$less = new lessc;
$less->setFormatter("compressed");
$less->checkedCompile($path.$file.".less", $path.$file.".css");
//$less->compileFile($path.$file.".less", $path.$file.".css");
header('Content-type: text/css');
echo file_get_contents($path.$file.".css");
?>