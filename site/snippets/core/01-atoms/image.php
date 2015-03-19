<?php 
	if(!isset($class)){ $class = ""; }
?>

<?php if(preg_match("=\.svg=", $bild)): ?>

<img class="scale <?php echo $class?>" src="<?php echo $bild; ?>">

<?php else: ?>

<img class="scale <?php echo $class?>" sizes="(min-width: 40em) 80vw, 100vw"
srcset="/assets/php/timthumb/images.php?src=<?php echo $bild; ?>w=375&q=85 375w, /assets/php/timthumb/images.php?src=<?php echo $bild; ?>w=480&q=85 480w, /assets/php/timthumb/images.php?src=<?php echo $bild; ?>w=768&q=85 768w">

<?php endif; ?>