<!-- Molecule: article -->
<article>
	<div class="head">
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
	</div>
	
	<div class="body">
		<?php
		if($content->text() != ""){
			snippet(get_atom("text"), array("text" => $content->text()));	
		} 
		?>
	</div>
	
	<?php if(sizeof($docs["all"]) >0): ?>
	<div class="documents">
		
		<?php
			$items = make_dldata_list($docs["all"]);
			snippet(get_atom("list-unordered"), array("items" => $items, "class" => "download-list" )); 
		?>
		
	</div>
	<?php endif; ?>
	
	<div class="foot">
		<?php
		if($content->date() != ""){
			snippet(get_atom("date"), array("date" => $content->date()));
		}
		
		if($content->autor() != ""){
			snippet(get_atom("autor"), array("text" => $content->autor()));
		}
		?>
	</div>
</article>
