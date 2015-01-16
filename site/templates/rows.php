<!-- Template: rows -->
	
<?php snippet('core/container/header') ?>

<main class="main" role="main">

	<section class="container">

		<?php foreach($containers as $container): ?>
		<div class="row">

			<?php
				
			// Snip holen
			$template = get_snip( $container->uid(), "einfach"); 
			$template = get_snip( $container->layout(), $template);
			$template = get_snip( $container->intendedTemplate(), $template);
			
			snippet($template, array(
				'content' => $container, 
				'snippet' => $template 
			)); 
			?>
			
		</div>
		<?php endforeach ?>

	</section>

</main>

<?php snippet('core/container/footer') ?>