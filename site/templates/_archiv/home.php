<!-- Template: Page -->
<?php include 'assets/php/functions.php'; ?>	
<?php snippet(get_organism("header")); ?>
<?php $containers = get_container($site, $pages, $page); ?>

<main class="main" role="main">

	<section class="container">

		<?php foreach($containers as $container): ?>
		<div class="row">

			<?php
			// Snip holen
			$template = get_snip( $container->uid(), "default"); 			
			$template = get_snip( $container->intendedTemplate(), $template);
			$template = get_snip( $page->layout(), $template);
	
			snippet($template, array(
				'content' => $container, 
				'snippet' => $template,
				'class' => $page->layout()
			)); 
			?>
			
		</div>
		<?php endforeach ?>

	</section>

</main>

<?php snippet(get_organism("footer")) ?>
