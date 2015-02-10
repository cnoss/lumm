<!-- Custom Organism: Article -->
<div class="stick-above-article">
	<?php 
		snippet(get_atom("headline"), array("text" => $content->title() ));
	?>
</div>
<div class="<?=$class?>">
<?php 
	snippet(get_molecule("article-headless"), array("content" => $content ));
?>
</div>