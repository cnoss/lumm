<!-- Snippet: <?php echo $snippet; ?> -->
<div class="text">
<?php if($content->headline() != ""): ?>
<h1><?php echo $content->headline(); ?></h1>
<?php endif; ?>

<?php if($content->subheadline() != ""): ?>
<h2><?php echo $content->subheadline(); ?></h2>
<?php endif; ?>

<?php if($content->text() != ""): ?>
<p><?php echo $content->text(); ?></p>
<?php endif; ?>
</div>
