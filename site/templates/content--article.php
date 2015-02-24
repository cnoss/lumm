<!-- Template: container--rows -->
<?php 
	include 'assets/php/functions.php';
	snippet(get_organism("header"));
?>

<main class="main" role="main">

	<section class="container">
		<div class="row">
			<div class="col-md-12">
			<?php 
				snippet(get_organism("content--article"), array("content" => $page, "class" => $page->layout()));
			?>
			</div>
		</div>

	</section>
</main>

<?php snippet(get_organism("footer")) ?>