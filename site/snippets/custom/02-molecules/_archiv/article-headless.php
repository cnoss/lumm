<!-- Molecule: article -->
<article>

	
	<div class="body">
		<?php
		if($content->text() != ""){
			snippet(get_atom("text"), array("text" => $content->text()));	
		} 
		?>
	</div>

</article>
