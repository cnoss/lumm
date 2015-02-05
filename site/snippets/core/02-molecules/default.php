<!-- Molecule: default -->
<?php 

if($content->headline() != ""){
	snippet("core/01-atoms/headline", array("text" => $content->headline() ));
}

if($content->subheadline() != ""){
	snippet("core/01-atoms/subheadline", array("text" => $content->subheadline() ));
}

if($content->text() != ""){
	snippet("core/01-atoms/text", array("text" => $content->text() ));	
} 

?>


