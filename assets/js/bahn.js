/* Bildgalerie
############################################ */
var bildgroessen = [];
bildgroessen["xs"] = 500;
bildgroessen["sm"] = 992;
bildgroessen["md"] = 1200;
bildgroessen["lg"] = 1200;

var bildkompression = [];
bildkompression["xs"] = 75;
bildkompression["sm"] = 75;
bildkompression["md"] = 70;
bildkompression["lg"] = 70;

var tt_url = "/assets/php/timthumb/images.php";

function init_blueimg(uid, type, idx){

	var gallery_id = '#blueimp-gallery-'+uid;
	var links = $('#links-'+uid + " a");
	var caption_container = $("#blueimp-gallery-caption-" + uid);
	var caption_container_small = false;
	var autostart = $(gallery_id).data("autostart");
	var continuous = false;	 
	var transitionSpeed = 200;
	if(autostart){ 
		transitionSpeed = 600; 
		continuous = true;
	}
	
	
	// Gibt es für ein alternatives Layout noch einen Container?
	if($("#blueimp-gallery-caption-" + uid + "-small").length > 0){
		caption_container_small = $("#blueimp-gallery-caption-" + uid + "-small");
	}

	var options = {
		continuous: continuous, 
		container: '#blueimp-gallery-'+uid, 
		carousel: true,
		preloadRange: 1,
		transitionSpeed: transitionSpeed,
		toggleControlsOnReturn: false,
		index: parseInt(idx) || 0,
		startSlideshow: autostart
	}

	if(type === "svgs"){
		$(options.container).find(".indicator").addClass('svgs');
	} else {
		options.stretchImages = 'cover';
	
		if(caption_container.length > 0){
			options.onslide = function (index, slide) {
				var caption_title = "<h3>" + this.list[index].getAttribute('data-caption-title') + "</h3>",
					caption_text = "<p>" + this.list[index].getAttribute('data-caption-text') + "</p>",
					linkurl = this.list[index].getAttribute('data-url');
					caption_container.empty();
					if(caption_container_small){ caption_container_small.empty(); }
				if (caption_title) {
					var t = caption_title + caption_text;
					if(linkurl.match(/[a-z]/)){ t = '<a href="'+linkurl+'">'+caption_title+'</a>'; }
					caption_container.html(t);
					if(caption_container_small){ caption_container_small.html(t); }
				}
			}
		}
	}
	
	// Wir geben den Links direkt die optimale größe mit
	links.each(function(ele){
		var href = $(this).attr("href");
		href = href.replace(/w=.*?[&|$]/, "");
		href = href.replace(/h=.*?[&|$]/, "");

		var new_href = tt_url + "?src=" + href + "&w=" + bildgroessen[viewmode] + "&q=" + bildkompression[viewmode]; // "&s=1" macht das bild unscharf ss 20141127
		
		//if(href.match(/\.svg/)){ new_href = href; }
		$(this).attr("href", new_href);
	});

	blueimp.Gallery( links, options );

}
	
	
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


	
/* Main
############################################ */	

$(document).ready(function () {

	// Wie groß ist das Device
	viewmode = detect_viewmode.get();
	
	if(mobile){
		FastClick.attach(document.body);	// fastClick aktivieren		
	}
	
	/* Blueimg initialisieren
	############################################ */
	var galleries = {};
	
	$(".blueimp-gallery").each(function(index, ele){
		var $id = $(ele).attr("id") + "ok";
		galleries[$id] = {};
		galleries[$id].offset = $(ele).parent().offset();
	});
    
	$(".blueimp-gallery").each(function(){
		var self = $(this);
		var uid = self.data("uid");	
		init_blueimg(uid);
	});
	
	
	

});





