<!-- Organism: Article Overview -->
<div class="<?=$class?>">
	
<?php 
	snippet(get_molecule("heading"), array("content" => $content )); 
	
	if($content->text() != ""){
		snippet(get_atom("text"), array("text" => $content->text()));
	}
?>
	
<?php 
	$containers = $content->children();
	$items = make_menu_items($containers);
?>

<?php 
	snippet(get_atom("list-unordered"), array("items" => $items, "class" => "link-list" )); 
?>
</div>