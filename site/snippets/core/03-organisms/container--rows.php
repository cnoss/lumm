<?php 
	$containers = get_container($site, $pages, $page); 
	foreach($containers as $container): 
?>
<div class="row">
	<div class="col-md-12">
	<?php
	
	// Bilder holen
	$bilder = get_images_from_article( $container );
	
	// Dokumente holen
	$docs = get_documents_from_article( $container );	
	
	// Snip holen
	$template = get_snip( $container->uid(), "default"); 			
	$template = get_snip( $container->intendedTemplate(), $template);
	
	snippet($template, array(
		'content' 	=> $container, 
		'snippet' 	=> $template,
		'class' 	=> $container->layout(),
		'bilder' 	=> $bilder,
		'docs'		=> $docs
	)); 
	?>
	</div>
</div>
<?php endforeach ?>
