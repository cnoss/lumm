<?php

/**
 * Kann für bestimmte Bereiche die Parameter fuer das TimThumb anpassen, z.B. um ein bestimmtes Seitenverhaeltnis herzustellen.
 * 
 * @author c.noss@klickmeister.de
 * @return HTML-Code 
 */
 
 
function onclick_box( $link, $css = "" ){
	
	$ret = "class=\"$css\"";
	
	if(preg_match("=[a-z]=", $link)){  
		$ret = "onclick=\"location.href='".$link."'\" class=\"link $css\"";
	}
	
	return $ret; 
}


/**
 * Kann für bestimmte Bereiche die Parameter fuer das TimThumb anpassen, z.B. um ein bestimmtes Seitenverhaeltnis herzustellen.
 * 
 * @author c.noss@klickmeister.de
 * @return imgsrc 
 */
 
function tt_params( $page, $src, $w, $q=80 ){
	
	// Query String ziehen
	
	$temp = explode("?", $src);
	$data = array();
	$data["path"] = $temp[0];
	$data["query"] = $temp[1];
	
	parse_str($data["query"], $qs);
	
	// Daten aktualisieren
	$qs["w"] = $w;
	$qs["q"] = $q;
	
	// fuer bestimmte Bereiche was anpassenm
	if( $page->uid() == "home"){ $qs["h"] =  $w * 0.5625; }
	
	// Neue source bauen und zurueck geben
	$data["query"] = $qs;

	$new_qs = array();
	foreach($qs as $key=>$value){ array_push($new_qs, "$key=$value"); }
	$src = $data["path"] ."?". join("&",$new_qs);

	return $src; 
}



/**
 * Prüft, ob es ein spezielles Snipplet gibt. Falls nicht, wird das default Snip zurück gegeben.
 * 
 * @author c.noss@klickmeister.de
 * @return Name des Templates 
 */

function get_snip($uid, $default){
	
	$default = preg_replace("=.*/=", "", $default);
	
	$template_core_container = strtolower($uid);
	$template_core_content = strtolower($uid);
	$template_custom = strtolower($uid);	
	$template = $uid;

	if(!file_exists('site/snippets/core/container/'.$template.'.php')){ 	$template_core_container = false; }
	if(!file_exists('site/snippets/core/content/'.$template.'.php')){ 	$template_core_content = false; }
	if(!file_exists('site/snippets/custom/'.$template.'.php')){	$template_custom = false; }

	if($template_custom){ 				$template = "custom/". $template; }
	elseif($template_core_container){ 	$template = "core/container/". $template; }
	elseif($template_core_content){ 	$template = "core/content/". $template; }
	else{								$template = "core/content/" . $default; }

	return $template;
}

/**
 * Liefert die Bilder eines Artikels kategorisiert nach Typ
 * 
 * @author c.noss@klickmeister.de
 * @return multidimensionales array mit bildern 
 */
 
function get_images_from_article( $article, $prop = false ){
	
	$bilder = array();
	$bilder["all"] = array();
	$bilder["svgs"] = array(); // Ehemals SVGs, wurden dann aber in PNGs konvertiert wegen Darstellungsproblemen bei Android
	$bilder["pixel"] = array();
	$bilder["lg"] = array();
	$bilder["thumbs"] = array();
	
	
	// Alle Bilder abklappern
	foreach ($article->images() as $img){
		switch (true) {
			case preg_match("=/icon.png=", $img):
				break;
				
			case preg_match("=/lg_=", $img):
				array_push($bilder["lg"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&q=80");
				break;
				
			case preg_match("=svg.png=", $img):
				array_push($bilder["svgs"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&q=80");
				array_push($bilder["all"],"/assets/php/timthumb/images.php?src=". $img->url()."&w=800&q=80");
				break;
			
			case $prop="proportional":
				array_push($bilder["pixel"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&q=80");
				array_push($bilder["all"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&q=80");
				array_push($bilder["thumbs"], "/assets/php/timthumb/images.php?src=".$img->url() ."&w=60&h=60&q=95&zc=1&s=1");
				break;
			
			default:
				array_push($bilder["pixel"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&h=600&q=80");
				array_push($bilder["all"], "/assets/php/timthumb/images.php?src=".$img->url()."&w=800&h=600&q=80");
				array_push($bilder["thumbs"], "/assets/php/timthumb/images.php?src=".$img->url() ."&w=60&h=60&q=95&zc=1&s=1");
		}
	}

	return $bilder;

}

?>