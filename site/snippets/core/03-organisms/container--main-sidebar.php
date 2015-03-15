<!-- Organism: Main-Sidebar -->

<?php 
	if(isset($content)){
		$heading_content = $content;
	}else{
		$heading_content = $page;
	}
?>

<?php if($heading_content->headline_zeigen() == "true"): ?>
<div class="row">
	<div class="col-md-8">
		<?php
			snippet(get_molecule("heading"), array("content" => $heading_content, "class" => "h--hero" ));
		?>
	</div>
</div>
<?php endif; ?>

<div class="row">
	<div class="col-md-8 hauptspalte">
		<?php			
			if(isset($content)){
				$containers = $content->find("hauptspalte")->children()->visible();
			}else{
				$containers = $page->find("hauptspalte")->children()->visible();
			}
			foreach($containers as $container): ?>
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
		<?php endforeach ?>
	</div>
	
	<div class="col-md-4 sidebar">
		<?php	
			if(isset($content)){
				$containers = $content->find("sidebar")->children()->visible();
			}else{
				$containers = $page->find("sidebar")->children()->visible();
			}
			foreach($containers as $container):
			
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
				'bilder'	=> $bilder,
				'docs'		=> $docs
			)); 
		?>
		<?php endforeach ?>
	</div>
</div>