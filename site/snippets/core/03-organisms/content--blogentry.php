<!-- Organism: Blogentry -->
<div class="<?=$class?>">
<?php 
	if(!isset($docs)){ $docs = false; }
	
	snippet(get_molecule("article"), array(
		"content" 	=> $content,
		"docs"		=> $docs
	));
?>
</div>

