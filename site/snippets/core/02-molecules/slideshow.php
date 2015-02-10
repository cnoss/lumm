<!-- Molecule: slideshow -->

<?php 

// Falls es nur ein Bild gibt, zeigen wir es an
########################################
if(count($bilder["all"]) == 1){
	snippet(get_atom("image"), array("bild" => $bilder["all"][0]));	
}

?>
