<?

# minimiert js
function minify($content){
	require_once('compressor-jsmin.php');
	return jt_JSMin::minify($content);
}


# check ob str in url
function inurl($str) {
	#http referer geht manchmal nicht klar!!! achtung!!
	if(!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) return false;
	return preg_match("=".$str."=",$_SERVER['HTTP_REFERER']); //$_SERVER['SCRIPT_FILENAME'] -> jt_compress, deswegen ref
}

# ie version oder false
function ieversion() {
	$match=preg_match('/MSIE ([0-9]\.[0-9])/',$_SERVER['HTTP_USER_AGENT'],$reg);
	if($match==0) return false;
	return floatval($reg[1]);
}

# löscht alles aus dem cache ordner
function clear_cache($str=""){
	global $cache_dir,$basispfad;
	$cdir=$basispfad.$cache_dir;
	if(strpos($cdir,"cache")===false) die("cache-error-kompress-f");#return false; # security
	$dircontent = scandir($basispfad.$cache_dir);
	foreach($dircontent as $filename) {
		if(strlen($filename)>2) {# && strpos($filename,$type)!==false
			# alle löschen bei force
			if($str=="force")  unlink($cdir.$filename);
			# nur alte löschen (20 tage)
			else {
				if(@filemtime($filename)) {
					if(date("Ymd", filemtime($filename))-date("Ymd")>20) unlink($cdir.$filename);
				}
			}
		}
	}
}

function get_font_format(){
	require_once 'struktur/lib/php-user-agent/lib/phpUserAgent.php';
	$userAgent = new phpUserAgent();

	switch ( $userAgent->getBrowserName() ) {
		case 'msie':
	        if ($userAgent->getBrowserVersion() < 9) return 'eot';
	        else return 'woff';
	    
	    case 'android':
	    	return 'ttf';
	    
	    case 'safari':
	    	if ($userAgent->getBrowserVersion() < 4.2) return 'svg';
	    	else if ($userAgent->getBrowserVersion() < 5) return 'ttf';
	    	else return 'woff';
	    
	    case 'firefox':
	    	if ($userAgent->getBrowserVersion() < 3.6) return 'ttf';
	    	else return 'woff';
	    
	    case 'opera':
	    	if ($userAgent->getBrowserVersion() < 11) return 'ttf';
	    	else return 'woff';
	    	 
	    default:
	        return 'woff';
	}
}
	
?>