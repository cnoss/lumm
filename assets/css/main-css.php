<?php

include_once('../../config/custom-config.php');

// Any updates?
$changes =  max(array(filemtime("less"), filemtime("less/00-base"), filemtime("less/01-atoms"), filemtime("less/02-molecules"), filemtime("less/03-organisms")));

if((!file_exists("main-css.less")) || ($changes > filemtime("main-css.less"))){
	
	// Core variables and mixins
	$import = array(
		"./less/variables_bootstrap.less",
		"../lib/bootstrap/less/mixins.less",
		"./less/variables_custom.less"
		
	);
	
	// Where are the less files?
	$base 			= "./less/00-base";
	$atoms		 	= "./less/01-atoms";
	$molecules	 	= "./less/02-molecules";
	$organisms	 	= "./less/03-organisms";
	
	// Cache leeren
	$cached_files = glob( $custom_config["cachedir"] );
	foreach($cached_files as $file){ 
		unlink($file);
	}
	
	// get less files
	$base_less 		= glob( $base . '/*.less' );
	$atoms_less 	= glob( $atoms . '/*.less' );
	$molecules_less = glob( $molecules . '/*.less' );
	$organisms_less = glob( $organisms . '/*.less' );
	
	// generate less stack with all less files
	$less_stack = array_merge($base_less, $atoms_less, $molecules_less, $organisms_less);
	
	// generate Main less file
	$main_less = "";
	foreach($import as $file){ 		$main_less .= "@import '" . $file . "';\n"; }
	foreach($less_stack as $file){ 	$main_less .= "@import '" . $file . "';\n"; }
	file_put_contents("main-css.less", $main_less);
	

}

// Generate CSS
require_once "../lib/less.php/Less.php";

try{
	$parser = new Less_Parser();
	$less_files = array( 'main-css.less' => '/' );
	
	$options = array( 
		'compress'			=>	true,
		'sourceMap'         => 	true,
	    'sourceMapWriteTo'  => 	'./sourcemaps/main.map',
	    'sourceMapURL'      => 	'./sourcemaps/main.map',
		'cache_dir' 		=> 	$custom_config["cachedir"]
	);

	$css_file_name = Less_Cache::Get( $less_files, $options );
	header('Content-Type: text/css');
	echo file_get_contents( $custom_config["cachedir"]."/".$css_file_name );

}catch(Exception $e){
    echo $e->getMessage();
}

?>