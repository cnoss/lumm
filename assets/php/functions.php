<?php

/**
 * Holt die Kinder einer Page
 * 
 * @author c.noss@klickmeister.de
 * @return Container Objekte 
 */
 
 
function get_container($site, $pages, $page) {

	// get all articles and add pagination
	$containers = $page->children(); // visible();

	// pass $articles and $pagination to the template
	//return compact('containers');
	return $containers;

};

/**
 * Prüft, ob es ein spezielles Snipplet gibt. Falls nicht, wird das default Snip zurück gegeben.
 * 
 * @author c.noss@klickmeister.de
 * @return Name des Templates 
 */

function get_snip($uid, $default){

	$default = preg_replace("=.*/=", "", $default);
	
	$tpl_core_organism = strtolower($uid);
	$tpl_custom_organism = strtolower($uid);
	
	$tpl = $uid;

	if(!file_exists('site/snippets/core/03-organisms/'.$tpl.'.php')){ 		$tpl_core_organism = false; }
	if(!file_exists('site/snippets/custom/03-organisms/'.$tpl.'.php')){ 	$tpl_custom_organism = false; }
	
	if($tpl_custom_organism){ 	$template = "custom/03-organisms/". $tpl; }
	elseif($tpl_core_organism){ $template = "core/03-organisms/". $tpl; }
	else{						$template = "core/03-organisms/" . $default; }

	return $template;
}


/**
 * Baut ein Menü Objekt
 * 
 * @author c.noss@klickmeister.de
 * @return Menü Objekt 
 */
 
 
function make_menu_items($pages, $class) {
			
	// alle Seiten holen
	$p = $pages->visible();
	
	// Rückgabeobjekt erzeugen
	$menu = array();
	
	// Wenn es Seiten gibt, dann diese abarbeiten
	if($p->count() > 0){
		foreach($p as $single_page){
			
			// Daten aufbereiten
			$data = array();
			$data["content"] = 	$single_page->title()->html();
			$data["active"] = 	"";if($single_page->isOpen()){ $data["active"] = 'class="active"';}
			$data["url"] = 		$single_page->url();
			
			// Markup erzeugen
			$item = array();
			$item["content"] = '<a '. $data["active"] .' href="'.$data["url"].'">'.$data["content"].'</a>';
			$item["class"] = $class."__item";
			array_push($menu, $item);
		}

	}
	
	return $menu;

};


?>