/* Config
------------------------------------------------------*/


/* Functions
------------------------------------------------------*/





/* Twitter integration
############################################ */

var twitter = {};
twitter.func = (function(){

	// lokale Variablen
	var tweets	 		= false,
		exports 		= {};
	
	// lokale Funktionen
	function get_tweets(){

		$.get('/assets/php/twitter/twitter.php', function(data){ $('#twitterfeed').append(data); });
		return true;
	}
      	
	// öffentliche Funktionen und init
	exports.init = function(){
		return get_tweets();
	};
	
	// öffentliche Funktionen bekanntgeben
	return exports;
})();






/* Anzeigemodus detectieren
############################################ */

detect_viewmode = (function(){

	// lokale Variablen
	var viewmode 		= "xs",
		exports 		= {};
	
	// lokale Funktionen
	function get_viewmode(){
		if($(".detect.visible-xs-block").is(':visible')){ viewmode = "xs"; }
		if($(".detect.visible-sm-block").is(':visible')){ viewmode = "sm"; }
		if($(".detect.visible-md-block").is(':visible')){ viewmode = "md"; }
		if($(".detect.visible-lg-block").is(':visible')){ viewmode = "lg"; }
		this.viewmode = viewmode;
		return viewmode;
	}
      	
	// öffentliche Funktionen und init
	exports.get = function(){
		return get_viewmode();
	};
	
	// öffentliche Funktionen bekanntgeben
	return exports;
})();






/* Bildgalerie
############################################ */
var slideshow = new Object();
slideshow.bildgroessen = [];
slideshow.bildgroessen["xs"] = 400;
slideshow.bildgroessen["sm"] = 992;
slideshow.bildgroessen["md"] = 992;
slideshow.bildgroessen["lg"] = 992;

slideshow.bildkompression = [];
slideshow.bildkompression["xs"] = 80;
slideshow.bildkompression["sm"] = 80;
slideshow.bildkompression["md"] = 75;
slideshow.bildkompression["lg"] = 75;

slideshow.tt_url = "/assets/php/timthumb/images.php";

slideshow.func = (function(){

	// lokale Variablen
	var gallery_id 			= false,
		links				= false,
		caption_container	= false,
		autostart			= false,
		continuous			= false,
		transitionSpeed		= false,
		options				= false,
		exports 		= {};
	
	// lokale Funktionen
	function init( uid, idx ){
		
		gallery_id = '#blueimp-gallery-'+uid;
		links = $('#blueimp-gallery-links-'+uid + " a");
		caption_container = $("#blueimp-gallery-caption-" + uid);
		autostart = $(gallery_id).data("autostart");
		if(autostart){ 
			transitionSpeed = 600; 
			continuous = true;
		}
		
		options = {
			continuous: continuous, 
			container: '#blueimp-gallery-'+uid, 
			carousel: true,
			preloadRange: 1,
			transitionSpeed: transitionSpeed,
			toggleControlsOnReturn: false,
			index: parseInt(idx) || 0,
			startSlideshow: autostart,
			stretchImages: 'cover'
		}
		
		return true;
	}
	
	function set_image_sizes( viewmode ){
		console.log(viewmode);
		// Wir geben den Links direkt die optimale größe mit
		links.each(function(ele){
			var href = $(this).attr("href");
			href = href.replace(/w=.*?[&|$]/, "");
			href = href.replace(/h=.*?[&|$]/, "");

			var new_href = slideshow.tt_url + "?src=" + href + "&w=" + slideshow.bildgroessen[viewmode] + "&q=" + slideshow.bildkompression[viewmode]+"&s=1";
			$(this).attr("href", new_href);
		});
		
		return true;
	}
      	
	// öffentliche Funktionen und init
	exports.init = function( uid, viewmode, type, idx ){
		init( uid );
		set_image_sizes( viewmode );
		blueimp.Gallery( links, options );
		return true;
	};
	
	// öffentliche Funktionen bekanntgeben
	return exports;
})();


/* Main
------------------------------------------------------*/

$(document).ready(function () {
	
	// Fire the init actions
	while( init_actions.length ){ eval( init_actions.shift() ); }
	
	// Wie groß ist das Device
	viewmode = detect_viewmode.get();
	
	// Blueimg initialisieren
	var galleries = {};
	
	$(".blueimp-gallery").each(function(index, ele){
		var $id = $(ele).attr("id") + "ok";
		galleries[$id] = {};
		galleries[$id].offset = $(ele).parent().offset();
	});
    
	$(".blueimp-gallery").each(function(){
		var self = $(this);
		var uid = self.data("uid");	
		slideshow.func.init( uid, viewmode );
	});
	


	
	
});