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
		if(isset($excerpt)){
			snippet(get_atom("text"), array("text" => $excerpt));	
			
		}else if($content->text() != ""){
			snippet(get_atom("text"), array("text" => $content->text()));	
		} 
		?>
		
		<?php
		// Do we have a URL and a linkname?
		if(isset($link["text"])){ 
			snippet(get_atom("text"), array("text" => get_kirby_linksyntax($link)));
		
		// or do we have a link only?
		}else if(isset($link)){
			snippet(get_atom("text"), array("text" => $link));
		}
		?>
	</div>
	
	<?php if(isset($docs) && sizeof($docs["all"]) >0): ?>
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
		
		if($content->tags() != ""): ?>
			
		<!--div class="tag-list-wrap">
			<span class="glyphicon glyphicon-tags"></span>
			<?php
				$items = make_tag_list($content->tags());
				snippet(get_atom("list-unordered"), array("items" => $items, "class" => "tag-list" )); 
			?>
		</div-->
		<?php endif; ?>
	</div>
</article>
