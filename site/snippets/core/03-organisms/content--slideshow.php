<!-- Organism: Slideshow -->
<div class="<?=$class?>">
<?php 
	snippet(get_molecule("slideshow"), array(
		"content" 	=> $content, 
		"bilder" 	=> $bilder,
		"kennung"	=> $content->slug(),
		"autostart"	=> $content->autostart()
	));
?>
</div>