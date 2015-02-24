<!-- Organism: Slideshow -->
<div class="<?=$class?>">

<div class="head">
	<?php 
		snippet(get_molecule("heading"), array(
			"content" 	=> $content
		));
	?>
</div>

<?php 
	snippet(get_molecule("slideshow"), array(
		"content" 	=> $content, 
		"bilder" 	=> $bilder,
		"kennung"	=> $content->slug(),
		"autostart"	=> $content->autostart()
	));
?>
</div>