asas
<?php include 'assets/php/functions.php'; ?>
<?php snippet(get_organism("header")); ?>
<?php $containers = get_container($site, $pages, $page); ?> 

<section class="container">
<?php foreach($containers as $container): ?>

	<?php
		
	// Snip holen
	$template = get_snip( $container->uid(), "default"); 
	$template = get_snip( $container->layout(), $template);
	$template = get_snip( $container->intendedTemplate(), $template);

	snippet($template, array(
		'content' => $container, 
		'snippet' => $template 
	)); 
	?>
	
<?php endforeach ?>
</section>

<?php snippet(get_organism("footer")) ?>