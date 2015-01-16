<?php
require_once "../lib/less.php/Less.php";

try{
	$parser = new Less_Parser();
	
	$less_files = array( './less/main-css.less' => '/' );
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