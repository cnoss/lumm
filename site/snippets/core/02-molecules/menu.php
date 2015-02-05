<!-- Molecule: menu -->
<nav <?php if(isset($class)){ echo "class='".$class."'";} ?>>
<?php 
	snippet("core/01-atoms/list-unordered", array("items" => $items, "class" => $class ."_list" )); 
?>
</nav>