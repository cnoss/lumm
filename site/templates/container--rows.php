<!-- Template: container--rows -->
<?php include 'assets/php/functions.php'; ?>	
<?php snippet(get_organism("header")); ?>
<?php $containers = get_container($site, $pages, $page); ?>

<main class="main" role="main">

	<section class="container">

	<?php 
		snippet(get_organism("container--rows"), array("containers" => $containers));
	?>

	</section>
</main>

<?php snippet(get_organism("footer")) ?>