<!-- Organism: Content-Head -->
<div class="row">
	<div class="col-md-12">
		<div class="content-head">
		
		<?php 
			
		if($content->headline() != ""){
			snippet("core/01-atoms/headline", array("text" => $content->headline()));
		}
		
		if($content->subheadline() != ""){
			snippet("core/01-atoms/subheadline", array("text" => $content->subheadline()));
		}

		if($content->teasertext() != ""){
			snippet("core/01-atoms/text", array("text" => $content->teasertext()));
		}
		
		?>
		
		</div>
	</div>
</div>