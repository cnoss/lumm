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

if($content->text() != ""){
	snippet(get_atom("text"), array("text" => $content->text()));	
} 

?>
