<!DOCTYPE html>
<html lang="<?php echo $site->language()->code(); ?>">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
<meta name="description" content="<?php echo $site->description()->html() ?>">
<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">
<link rel="stylesheet" type="text/css" href="/assets/css/above-the-fold.min.css">


<script>
	
// Stack of js actions, that have to be fired, after the page is loaded
var init_actions = new Array();	

</script>
</head>

<body>


<header class="container">
	
	<div class="row">
		<div class="col-md-12">
			<div class="logo">
				<a href="<?php echo $site->homePage()->url(); ?>">
			<?php
				snippet(get_molecule("heading"), array("content" => $site ));
			?>
				</a>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="main-menu">
			<?php
				$items = make_menu_items($pages);
				snippet(get_molecule("menu"), array("items" => $items ));
			?>
			</div>
		</div>
	</div>
	
</header>
