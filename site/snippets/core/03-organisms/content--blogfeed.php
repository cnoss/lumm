<!-- Organism: Blogfeed -->


<?php // Shall we show a ruler to Seperate the Content?
	
	if($content->ruler() == "ruler"){
		snippet(get_atom("hr"));
	}
	
?>

<?php // Process Blog Content
	
	// How many articles should be shown?
	$limit = 10;
	if($content->anzahl() != ""){ $limit = $content->anzahl()->value(); }
	if($content->layout() == "part-of-content"){ $limit--; }
		
	// What kind of articles should be shown?
	$type = false;
	if($content->type() != ""){ $type = $content->type(); }

	if($type == "home"){
		$containers = $pages->index()->children()->filterBy('home','true')->sortBy('date', 'desc')->limit($limit);
	}else if($content->filter() != ""){
		$containers = $pages->index()->children()->filterBy('tags',$content->filter(), ',')->sortBy('date', 'desc')->limit($limit);
	}else{
		$containers = get_blog_container($site, $pages, $page, $limit);
	}
	
?>


<?php // Headline und Teasertext verarbeiten
	if($content->layout() != "no-head"){
		if($content->layout() == "headline-only"){
			snippet(get_molecule("heading"), array("content" => $content, "class" => "h--hero"));
			
		}else if($content->layout() == "part-of-content"){
			$containers = $containers->toArray();
			array_unshift($containers, $content);
		}else{
			snippet(get_organism("content--article"), array("content" => $content, "class" => $class));		
		}
			
	}
?>

<?php 

if($content->type_of_layout()=="excerpt"): ?>
	<div class="row blogfeed-grid">
	<?php foreach($containers as $container): 
		
		$link = array("text"=>"weiter lesen", "url"=> $container->url());
		
		// If Headline is part of content, don't show link ot itself
		if($content->url() == $container->url()){
			$link = "";
		}
		
	?>
		<div class="col-md-4 blogfeed-grid__item ">
			<div class="article">
				<?php snippet(get_molecule("article"), array(
					"content" 	=> $container, 
					"excerpt" 	=> $container->text()->excerpt(200),
					"link"		=> $link
				)); 
				?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>

<?php else:	
	foreach($containers as $container): ?>
	<div class="row">
		<div class="col-md-12 <?php echo $content->type_of_layout(); ?>">
			<?php
				
			// Snip holen
			$template = get_snip( $container->uid(), "default"); 
			$template = get_snip( $container->intendedTemplate(), $template);
		
			snippet($template, array(
				'content' 	=> $container, 
				'snippet' 	=> $template,
				'class' 	=> $container->layout(),
				'docs' 		=> $docs
			)); 
			?>
		</div>
	</div>

<?php 
	endforeach;
endif;	
?>
