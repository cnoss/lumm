<!-- Template: Page -->
<?php include 'assets/php/functions.php'; ?>	
<?php snippet(get_organism("header")); ?>


<main class="main" role="main">

	<section class="container">

		
		<div class="row">
			<div class="col-md-8">
				<?php $containers = $page->find("hauptspalte")->children()->visible(); ?>
				<?php foreach($containers as $container): ?>
				<?php
					
					// Bilder holen
					$bilder = get_images_from_article( $container );
					
					// Snip holen
					$template = get_snip( $container->uid(), "default"); 			
					$template = get_snip( $container->intendedTemplate(), $template);
	
					snippet($template, array(
						'content' 	=> $container, 
						'snippet' 	=> $template,
						'class' 	=> $container->layout(),
						'bilder' 	=> $bilder
					)); 
				?>
				<?php endforeach ?>
			</div>
			
			<div class="col-md-4">
				<?php $containers = $page->find("sidebar")->children()->visible(); ?>
				<?php foreach($containers as $container): ?>
				<?php
					
					// Bilder holen
					$bilder = get_images_from_article( $container );
					
					// Snip holen
					$template = get_snip( $container->uid(), "default"); 			
					$template = get_snip( $container->intendedTemplate(), $template);
	
					snippet($template, array(
						'content' 	=> $container, 
						'snippet' 	=> $template,
						'class' 	=> $container->layout(),
						'bilder'	=> $bilder
					)); 
				?>
				<?php endforeach ?>
			</div>
		</div>
		
	</section>
</main>

<?php snippet(get_organism("footer")) ?>