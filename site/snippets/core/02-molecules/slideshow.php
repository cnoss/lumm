<!-- Molecule: slideshow -->
<?php 

// Falls es nur ein Bild gibt, zeigen wir es an
########################################
if(count($bilder["all"]) == 1):
	snippet(get_atom("image"), array("bild" => $bilder["all"][0]));	
else:

	if(!isset($class)){ $class = ""; } 
	if(!isset($template)){ $template = ""; } 
	if(!isset($type)){ $type = "all"; }
	if(!isset($kennung)){ $kennung = ""; } 		
	if(!isset($idx)){ $idx = "0"; } 
	if(!isset($autostart)){ $autostart = "false"; } 
	if($content->ratio() == ""){ $ratio = "ratio-2zu1"; } else{ $ratio = $content->ratio(); }
?>
	<div id="blueimp-gallery-<?php echo $kennung; ?>" data-autostart="<?php echo $autostart ?>" data-uid="<?php echo $kennung; ?>" class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls <?php echo $class;?> <?php echo $ratio;?>">
	    <div class="slides"></div>
	    <!--h3 class="title"></h3-->
	    <!--a class="prev">‹</a-->
	    <!--a class="next">›</a-->
	    <!--a class="close">×</a-->
	    <!--a class="play-pause"></a-->
	    <ol class="indicator"></ol>
	</div>
	
	<div id="blueimp-gallery-links-<?php echo $kennung; ?>" data-uid="<?php echo $kennung; ?>">
		<?php 
			foreach ($bilder[$type] as $bild): 
		?>	
		<a href="<?php echo $bild; ?>"></a>
		<?php endforeach; ?>
	</div>
	
	
<?php endif; ?>
