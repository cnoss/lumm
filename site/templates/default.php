<?php snippet('core/03-organisms/header') ?>
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

<?php snippet('core/03-organisms/footer') ?>