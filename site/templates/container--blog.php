<?php include 'assets/php/functions.php'; ?>
<?php $containers = get_blog_container($site, $pages, $page, 200); ?>
<?php snippet(get_organism("header")); ?>

<section class="container">
<?php foreach($containers as $container): ?>
	<div class="row">
		<div class="col-md-12">
			<?php
				
			// Snip holen
			$template = get_snip( $container->uid(), "default"); 
			$template = get_snip( $container->intendedTemplate(), $template);
		
			snippet($template, array(
				'content' => $container, 
				'snippet' => $template,
				'class' => $container->layout()
			)); 
			?>
		</div>
	</div>

<?php endforeach ?>
</section>

<?php snippet(get_organism("footer")); ?>