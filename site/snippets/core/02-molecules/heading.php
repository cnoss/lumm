<!-- Molecule: heading -->
<?php 

if($content->headline() == ""){
	snippet(get_atom("headline"), array("text" => $content->title()));
}else{
	snippet(get_atom("headline"), array("text" => $content->headline()));
}

if($content->subheadline() != ""){
	snippet(get_atom("subheadline"), array("text" => $content->subheadline()));
}
?>
