<!-- Organism: default -->
<div class="col-md-12">
<?php 
	if(!isset($class)){ $class = ""; }
	snippet(get_molecule("default"), array("content" => $content, "class" => $class ));
?>
</div>

