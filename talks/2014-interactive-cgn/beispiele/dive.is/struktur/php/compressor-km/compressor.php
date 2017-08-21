<? # js / css kompressor


# type klarmachen
if(!isset($_GET['type']) || empty($_GET['type'])) die("no type");
if($_GET['type']=="js") $compressor_type="js";
else if($_GET['type']=="css") $compressor_type="css";
else die("wrong type");



/* konfigurationen laden
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

# funktionen laden
require_once("compressor-functions.php");

# konfiguration und dateilisten laden
#require_once("../global/init-km.php");
require_once("compressor-config.php");

#$devmode = functions_km::devmode();
#$devmode = true;


/* header schreiben
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

# expires tag
$expires=60*60*24*7;
header('Content-type: text/'.(($compressor_type=="js")?"javascript":"css").'; charset=utf-8');
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: '.gmdate('D, d M Y H:i:s',time()+$expires).' GMT');




/* cache - checken
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
# cache leeren
if(isset($_GET['clear_cache']) && !empty($_GET['clear_cache']) && $_GET['clear_cache']=="true") {
	clear_cache("force");
}


# md5 string erstellen
$md5_cache="";
foreach($dateien as $file){
	if(file_exists($basispfad.$file)) $md5_cache.=date("YmdHis", filemtime($basispfad.$file)).$file.$rawcode; #else echo"not exists: $file";
}

# cache checken
$md5_cache=md5($md5_cache);
$cache_filename=$cache_dir.$md5_cache."_".((!$devmode)?"compressed":"uncompressed").".js";
$cache_filename_fullpath=$basispfad.$cache_filename;


if(file_exists($cache_filename_fullpath)) {
	die(file_get_contents($cache_filename_fullpath));
}



/* kein cache da - ohne cache weiter
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

# gzip macht der server evtl. selber - bei doppeltem gzippen kommt "Content Encoding Error"
ob_start("ob_gzhandler");

# eigentlicher inhalt der nachher in der datei steht
$content="";


# externe dateien einbinden / bzw dateien im devmode einbinden
if($compressor_type=="js") {
	
	if(count($externe_dateien)>0) {
		
		$content.="document.write(\"";
		# externe dateien
		foreach($externe_dateien as $file) $content.='<script src=\"'.$file.'\" type=\"text/javascript\"></script>';
		if($devmode) {
			for($i=0;$i<count($dateien);$i++) $content.='<script src=\"'.$dateien[$i].'\" type=\"text/javascript\"></script>';
			$content.='<script>'.$rawcode.'</script>';
		}
		$content.="\");";
	}
}

# css laden
else {

	# less kompilieren
	require($less_inc_path);
	
	
	$less = new lessc;
	$less->addImportDir('../../lib/bootstrap/less/');
	$less->setFormatter("compressed");
	
	$less_datei_input='../../'.$less_file;
	$less_datei_output='../../'.$less_style_file;
	
	if((filemtime('../../css/global/articles.less') > filemtime('../../'.$less_file)) ||  (filemtime('../../css/global/icons.less') > filemtime('../../'.$less_file)))
		$less->compileFile($less_datei_input,$less_datei_output);
	else
		$less->checkedCompile($less_datei_input,$less_datei_output);
	
	require_once('struktur/lib/php-user-agent/lib/phpUserAgent.php');
	$userAgent = new phpUserAgent();
	
	if($devmode) {
		#for($i=0;$i<count($dateien);$i++) $content.='@import url('.$compressor_server.'/struktur/'.$dateien[$i].');';
		#for($i=0;$i<count($dateien);$i++) $content.=  file_get_contents($compressor_server.'/struktur/'.$dateien[$i]).' ';
		
	/*
	if($userAgent->getBrowserName()=="msie" && $userAgent->getBrowserVersion()<9)
			foreach($dateien as $d)$content.=(strpos($d,'rotis'))?('@import url('.$compressor_server.'/struktur/'.$d.');'):(file_get_contents($compressor_server.'/struktur/'.$d));
		else
*/
		for($i=0;$i<count($dateien);$i++) $content.='@import url('.$dateien[$i].');';
	}

}


# inhalte cachen
if(!$devmode) {

	# alten cache löschen
	clear_cache(); # wird hier das script verlangsamt???

	# inhalte laden
/* 	echo "<pre>";print_r($dateien);	die; */
	foreach($dateien as $file) {
		#$content.='console.log("km-compressor meldet: \''.$file.'\' #start.");';
		if(file_exists($basispfad.$file)) $content.=';'.file_get_contents($basispfad.$file).';';
		else $content.='console.log("km-compressor meldet: \''.$file.'\' nicht gefunden.");';
	}
	
	# js spez.
	if($compressor_type=="js") {
		$content.=$rawcode; # js - rawcode hinzufügen
		$content.=$google_analytics_js; # ga - code hinzufügen
		$content=minify($content); # inhalte minimieren
	}
	# neue datei erzeugen
	file_put_contents($basispfad.$cache_filename,$content);
	//chmod(functions_km::get_basispfad().'/'.$cache_filename,0777);
}

# ausgabe des komprimierten inhalts
echo $content;

# buffer beenden -> ausgabe
ob_end_flush();

?>