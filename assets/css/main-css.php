<?php

// Any updates?
$changes = round((filemtime("less") +  filemtime("less/core") +  filemtime("less/custom")) / 3);

if($changes > filemtime("main-css.less")){
	
	// Core variables and mixins
	$import = array(
		"./less/variables.less",
		"../lib/bootstrap/less/mixins.less",
		"./less/variables_custom.less"
		
	);
	
	// Where are the less files?
	$core_path 		= "./less/core";
	$custom_path 	= "./less/custom";
	
	// get filesnames and remove paths (in order to compare filenames)
	$core_less 		= str_replace($core_path, "", glob( $core_path . '/*.less' ));
	$custom_less 	= str_replace($custom_path, "", glob( $custom_path . '/*.less'));
	
	// find core files where no custom pendant is available
	$core_less = array_diff( $core_less, $custom_less );
	
	// add paths again
	$core_less = 	preg_filter('/^/', $core_path, $core_less);
	$custom_less = 	preg_filter('/^/', $custom_path, $custom_less);
	
	// generate less stack with all less files
	$less_stack = array_merge($core_less, $custom_less);
	
	// generate Main less file
	$main_less = "";
	foreach($import as $file){ 		$main_less .= "@import '" . $file . "';\n"; }
	foreach($less_stack as $file){ 	$main_less .= "@import '" . $file . "';\n"; }
	file_put_contents("main-css.less", $main_less);
	
	// Cache leeren
	$cached_files = glob( $core_path . './cached/' );
	foreach($cached_files as $file){ 
		unlink($file);
	}

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
		'cache_dir' 		=> 	'./cached/'
	);

	$css_file_name = Less_Cache::Get( $less_files, $options );
	header('Content-Type: text/css');
	echo file_get_contents( './cached/'.$css_file_name );

}catch(Exception $e){
    echo $e->getMessage();
}

?>