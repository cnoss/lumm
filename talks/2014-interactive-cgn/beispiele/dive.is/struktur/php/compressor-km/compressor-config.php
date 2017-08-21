<?

$compressor_server="http://".$_SERVER['HTTP_HOST'];
$basispfad='/home/dive/public_html/web.dive.is/';

# für js
if($compressor_type=="js") {

	# externe dateien
	$externe_dateien=array(
	);
	
	# dateien auf dem server
	$dateien=array(
		'/wp-content/themes/dive.is/struktur/lib/head.load.min.js',
		'/wp-content/themes/dive.is/struktur/lib/html5shiv.js',
		'/wp-content/themes/dive.is/struktur/lib/unveil/jquery.unveil.min.js',
		'/wp-content/themes/dive.is/struktur/lib/photoswipe-3.0.5/lib/klass.min.js',
		'/wp-content/themes/dive.is/struktur/lib/photoswipe-3.0.5/code.photoswipe.jquery-3.0.5.min.js',
		'/wp-content/themes/dive.is/struktur/lib/bootstrap/js/bootstrap-modal.js',
		'/wp-content/themes/dive.is/struktur/js/dive.js'
	);
/*
<!--script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/struktur/lib/arctext/js/jquery.arctext.js"></script-->
<!--script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/struktur/lib/prefixfree.min.js"></script-->
*/ 

	# roher javascript code
	$rawcode="";
	
	# ga code
	$google_analytics_js=" var _gaq = [['_setAccount', 'UA-909704-1'],['_anonymizeIp'],['_trackPageview']];
	 (function(d, t) {
	  var g = d.createElement(t),
	      s = d.getElementsByTagName(t)[0];
	  g.async = true;
	  g.src = '//www.google-analytics.com/ga.js';
	  s.parentNode.insertBefore(g, s);
	 })(document, 'script');";
	
	#<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	// jquery 1 für ie<9 , sonst jquery 2 - inklusive selbstgehostetem fallback
/*
	require_once('struktur/lib/php-user-agent/lib/phpUserAgent.php');
	$userAgent = new phpUserAgent();
	if($userAgent->getBrowserName()=="msie" && $userAgent->getBrowserVersion()<9) {
		$filename.="ltie9";
		$dateien=array_merge(array('lib/jquery/1.9.1/jquery.min.js'),$dateien);		
		$dateien=array_merge($dateien,array('lib/old_ie/respond.min.js'));
		$dateien=array_merge($dateien,array('lib/old_ie/html5shiv.js'));
#		$dateien=array_merge($dateien,array('lib/old_ie/ie8_fix_maxwidth.js'));
		$dateien=array_merge($dateien,array('lib/old_ie/modernizr.custom.10412.js'));
#		$externe_dateien=array_merge(array("http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"),$externe_dateien);
#		$rawcode.='!window.jQuery && document.write(\'<script src="/struktur/lib/jquery/1.9.1/jquery.min.js"><\script>\');';
		
	}
	else {
		$dateien=array_merge(array('lib/jquery/2.0.0/jquery.min.js'),$dateien);
		
		
#		$externe_dateien=array_merge(array("http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"),$externe_dateien);
#		$rawcode='!window.jQuery && document.write(\'<script src="/struktur/lib/jquery/2.0.0/jquery.min.js"><\script>\');';
	}
*/
	
	
	/* cache
	------------------------------------------------------------------------------*/
	# cache-ordner
	$cache_dir="cache/js/";

}

# css 
else {

	
	$less_inc_path='../../lib/lessphp/lessc.inc-km.php';
	$less_file='css/global/style.less';
	$less_style_file='css/global/style.css';
	
	
	# externe dateien
	$externe_dateien=array(
	);

	# dateien auf dem server
	$dateien=array(
		'css/rotis/'.get_font_format().'.css',
		$less_style_file
	);
	
	
	# roher javascript code
	$rawcode="";

	
	
	/* cache
	------------------------------------------------------------------------------*/
	# cache-ordner
	$cache_dir="cache/css/";

	
}

?>