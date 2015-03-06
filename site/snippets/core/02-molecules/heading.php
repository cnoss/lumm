<!-- Molecule: heading -->
<?php 

if(!isset($class)){ $class = ""; }

if($content->headline() == ""){
	snippet(get_atom("headline"), array("text" => $content->title(), "class" => $class));
}else{
	snippet(get_atom("headline"), array("text" => $content->headline(), "class" => $class));
}
if($content->subheadline() != ""){
	snippet(get_atom("subheadline"), array("text" => $content->subheadline(), "class" => $class));
}
?>
