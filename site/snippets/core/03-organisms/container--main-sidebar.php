<!-- Organism: Main-Sidebar -->
<div class="row">
	<div class="col-md-8">
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
		<?php	
			if(isset($content)){
				$containers = $content->find("sidebar")->children()->visible();
			}else{
				$containers = $page->find("sidebar")->children()->visible();
			}
			foreach($containers as $container):
			
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