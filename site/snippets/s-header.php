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

try{
	$parser = new Less_Parser();
	
	$less_files = array( 'assets/css/less/above-the-fold.less' => '/' );
	$options = array( 
		'compress'=>true,
		'sourceMap'         => true,
	    'sourceMapWriteTo'  => 'assets/css/sourcemaps/lumm-above-the-fold.map',
	    'sourceMapURL'      => 'assets/css/sourcemaps/lumm-above-the-fold.map',
		'cache_dir' => 'assets/css/cached/'
	);

	$css_file_name = Less_Cache::Get( $less_files, $options );
	echo file_get_contents( 'assets/css/cached/'.$css_file_name );

}catch(Exception $e){
    echo $e->getMessage();
}

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