<!DOCTYPE html>
<html lang="<?php echo $site->language()->code(); ?>">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
<meta name="description" content="<?php echo $site->description()->html() ?>">
<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

	
<style>
<?php
require_once "assets/lib/less.php/Less.php";

try{
	$parser = new Less_Parser();
	
	$less_files = array( 'assets/css/less/above-the-fold.less' => '/' );
	$options = array( 
		'compress'=>true,
		'sourceMap'         => true,
	    'sourceMapWriteTo'  => 'assets/css/sourcemaps/above-the-fold.map',
	    'sourceMapURL'      => 'assets/css/sourcemaps/above-the-fold.map',
		'cache_dir' 		=> 'assets/css/cached/'
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

<header class="container">
	
	<div class="row">
		<div class="col-md-12 logo">
			<?php
				snippet(get_molecule("heading"), array("content" => $site ));
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 main-menu">
		<?php
			$items = make_menu_items($pages);
			snippet(get_molecule("menu"), array("items" => $items ));
		?>
		</div>
	</div>
	
</header>