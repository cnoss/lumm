/* Config
------------------------------------------------------*/


/* Functions
------------------------------------------------------*/

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


/* Bildgalerie
############################################ */
var bildgroessen = [];
bildgroessen["xs"] = 600;
bildgroessen["sm"] = 992;
bildgroessen["md"] = 1200;
bildgroessen["lg"] = 1200;

var bildkompression = [];
bildkompression["xs"] = 85;
bildkompression["sm"] = 85;
bildkompression["md"] = 80;
bildkompression["lg"] = 80;

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
			options.onslideend = function (index, slide) {
				var caption_title = "<h3>" + this.list[index].getAttribute('data-caption-title') + "</h3>",
					caption_text = "<p>" + this.list[index].getAttribute('data-caption-text') + "</p>",
					linkurl = this.list[index].getAttribute('data-url');
					caption_container.empty();
					if(caption_container_small){ caption_container_small.empty(); }
				if (caption_title) {
					var t = caption_title + caption_text;
					if(linkurl.match(/[a-z]/)){ 
						t = '<a href="'+linkurl+'">'+caption_title+'</a>'; 
						hammer_o = new Hammer(document.getElementById('blueimp-gallery-'+uid));
						hammer_o.on("tap", function(ev) { location.href =linkurl; });
				
					}
					caption_container.html(t);
					if(caption_container_small){ caption_container_small.html(t); }
				}
				
			},
			options.onslide = function( index, slide ){
				//$(slide).unbind("mouseup");
			}
		}
	}
	
	// Wir geben den Links direkt die optimale größe mit
	links.each(function(ele){
		var href = $(this).attr("href");
		href = href.replace(/w=.*?[&|$]/, "");
		href = href.replace(/h=.*?[&|$]/, "");

		var new_href = tt_url + "?src=" + href + "&w=" + bildgroessen[viewmode] + "&q=" + bildkompression[viewmode]+"&s=1";
		
		//if(href.match(/\.svg/)){ new_href = href; }
		$(this).attr("href", new_href);
	});

	blueimp.Gallery( links, options );

}


/* Main
------------------------------------------------------*/

$(document).ready(function () {
	
	// Fire the init actions
	while( init_actions.length ){ eval( init_actions.shift() ); }
	
	// Blueimg initialisieren
	/*var galleries = {};
	
	$(".blueimp-gallery").each(function(index, ele){
		var $id = $(ele).attr("id") + "ok";
		galleries[$id] = {};
		galleries[$id].offset = $(ele).parent().offset();
	});
    
	$(".blueimp-gallery").each(function(){
		var self = $(this);
		var uid = self.data("uid");	
		init_blueimg(uid);
	});*/
	
	blueimp.Gallery(
		document.getElementById('blueimp-gallery-links-').getElementsByTagName('a'),{
        	container: '#blueimp-gallery-',
			carousel: true,
			stretchImages: true
    	}
	);

	
	
});