<!-- Organism: Twitterfeed -->
<?php 
	snippet(get_organism("content--article"), array("content" => $content, "class" => $class));
?>
<div id="twitterfeed" class="col-md-12"></div>

<script type="text/javascript">
	init_actions.push("twitter.func.init();");
</script>