<!-- Organism: Instafeed -->
<div id="instafeed" class="col-md-12"></div>

<script type="text/javascript">

init_actions.push("var feed = new Instafeed({ get: 'user', userId: <?php echo $site->userid();?>, accessToken: '<?php echo $site->accessToken();?>', clientId: '<?php echo $site->clientId();?>',template: '<a class=\"image_grid\" href=\"{{link}}\"><img class=\"scale\" src=\"{{image}}\" /></a>', resolution: 'low_resolution', limit: 12}); feed.run();");
    
</script>