<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
<meta name="description" content="<?php echo $site->description()->html() ?>">
<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

<style>
<?php
require "assets/lib/less.php/Less.php";

$parser = new Less_Parser();
$options = array( 
	'compress'=>true,
	'sourceMap'         => true,
    'sourceMapWriteTo'  => 'assets/css/sourcemaps/lumm-above-the-fold.map',
    'sourceMapURL'      => '/assets/css/sourcemaps/lumm-above-the-fold.map',
);
$parser = new Less_Parser( $options );
$parser->parseFile( 'assets/css/above-the-fold.less' );
echo $parser->getCss();

#$less = new lessc;
#$less->setFormatter("compressed");
#$less->checkedCompile($path.$file.".less", $path.$file.".css");
//$less->compileFile($path.$file.".less", $path.$file.".css");
#echo $less->compileFile("assets/css/above-the-fold.less");
?>


	
	

</style>

</head>
<body>

<header class="header cf" role="banner">
<a class="logo" href="<?php echo url() ?>">
<img src="<?php echo url('assets/images/logo.svg') ?>" alt="<?php echo $site->title()->html() ?>" />
</a>
<?php snippet('menu') ?>
</header>