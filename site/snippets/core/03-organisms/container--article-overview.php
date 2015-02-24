<!-- Organism: Article Overview -->
<?php 
	$containers = $content->children();
	$items = make_menu_items($containers);
?>

<?php 
	snippet(get_atom("list-unordered"), array("items" => $items, "class" => "link_list" )); 
?>