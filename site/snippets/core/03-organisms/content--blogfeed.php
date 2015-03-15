<!-- Organism: Blogfeed -->
<?php 
	
	// How many articles should be shown?
	$limit = 10;
	if($content->anzahl() != ""){ $limit = $content->anzahl()->value(); }

	// What kind of articles should be shown?
	$type = false;
	if($content->type() != ""){ $type = $content->type(); }

	if($type == "home"){
		$containers = $pages->index()->children()->filterBy('home','true')->sortBy('date', 'desc')->limit($limit); 	
	}else{
		$containers = get_blog_container($site, $pages, $page, $limit);
	}
	
?>

<?php 

if($content->type_of_layout()=="excerpt"): ?>
	<div class="row blogfeed-grid">
	<?php foreach($containers as $container): ?>
		<div class="col-md-4 blogfeed-grid__item ">
			<div class="article">
				<?php snippet(get_molecule("article"), array(
					"content" 	=> $container, 
					"excerpt" 	=> $container->text()->excerpt(200),
					"link"		=> array("text"=>"weiter lesen", "url"=> $container->url())
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
