<!-- Molecule: article -->
<article>
	<div class="head">
		<?php 
		if($content->headline() == ""){
			snippet("core/01-atoms/headline", array("text" => $content->title()));
		}else{
			snippet("core/01-atoms/headline", array("text" => $content->headline()));
		}
		
		if($content->subheadline() != ""){
			snippet("core/01-atoms/subheadline", array("text" => $content->subheadline()));
		}
		?>
	</div>
	
	<div class="body">
		<?php
		if($content->text() != ""){
			snippet("core/01-atoms/text", array("text" => $content->text()));	
		} 
		?>
	</div>
	
	<div class="foot">
		<?php
		if($content->date() != ""){
			snippet("core/01-atoms/date", array("date" => $content->date()));
		}
		
		if($content->autor() != ""){
			snippet("core/01-atoms/text", array("text" => $content->autor()));
		}
		?>
	</div>
</article>
