<!-- Template: container--main-sidebar -->
<?php 
	include 'assets/php/functions.php';
	snippet(get_organism("header"));
?>

<main class="main" role="main">

	<section class="container">

	<?php 
		snippet(get_organism("container--main-sidebar"));
	?>
		
	</section>
</main>

<?php snippet(get_organism("footer")) ?>