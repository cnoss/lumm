<!-- Organism: Blogfeed -->
<?php 
	$limit = 10;
	if($content->anzahl() != ""){ $limit = $content->anzahl()->value(); }
	$containers = $pages->index()->children()->filterBy('home','true')->limit($limit)->sortBy('date', 'desc'); 
?>

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
