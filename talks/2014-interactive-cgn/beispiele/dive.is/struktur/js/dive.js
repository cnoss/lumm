/*
dive.js
Klickmeister für dive.is
2012/13 Christian Noss, c.noss@klickmeister.de
*/

/* Scripte laden
================================= */
/*
  ms 20130325 dive.js Auslesen der freien Plätze aus Tooltip (Tooltip-Text 'Availbility: xx' sollte nicht geändert werden)
*/
/* ss 20130307 bootstrap.min.js auskommentiert: Das booking-calendarplugin bringt
ein eigenes mit. Die Dopplung führte dazu, dass keine Availability-Tooltips angezeigt wurden 
cn 05.09.2013: haben wir doch wieder reingenommen, da das Booking tool nicht immer angezeigt wird.
*/
//head.js( template_url+"/struktur/lib/bootstrap/js/bootstrap.min.js" );


/* Globale Variablen
================================= */
var max_participants = 16; // Wieviele Teilnehmer gibts maximal pro Tour/Kurs?
var display_mode = "desktop";

/* Funktionen
================================= */

function scrollto(element){
	$('html, body').animate({ scrollTop: ($(element).offset().top -300)}, 'slow');
};

var imgs_complete = function(){
	for(i=0; i<check_imgs.i_imgs; i++){
		if(check_imgs.imgs[i].complete){
			check_imgs.complete++;
		}
	}
	if(check_imgs.complete > check_imgs.i_imgs){
		clearInterval(check_imgs.interval);
		$("#km_loader").delay(1000).fadeOut(1000);
	}else{
		$("#km_loader").width(check_imgs.segmente * (check_imgs.complete + 1));		
	}

}

// Responsives Verhalten der Bilder
var rescale_images = function( query, obj ){

	var src_neu = query["imageserver"] + "/src=" + query["src"];
	var w = 0;
	var h = 0;
	var q = query["q"];
	
	//var dim = store_size( obj );

	/*if(w > 600){ q = 90; }
	if(w > 800){ q = 80; }
	if(w > 1000){ q = 60; }	*/		

	var ret =  src_neu + "&w=" + obj.attr("data-width") + "&h=" + obj.attr("data-height") + "&q=" + q + "&s=1" ;
	if(query["a"]){ ret += ret + "&a=" + query["a"]; }
	
	return ret;
}

var store_size = function( obj ){

	if(obj.attr("src")){
	
		if(obj.parent().hasClass("set_height")){
			w = obj.parent().width();
			h = obj.closest(".row").height();
		}else{
			w = obj.parent().width();
			h = obj.parent().height();
		}
		
	}else{
		w = obj.width();
		h = obj.height();
	}

	obj.attr("data-width", w);
	obj.attr("data-height", h);

	return true;
}

// Ausfaden der Seite beim verlassen
var leave = function( href ){	
	if(href && href.match(/http.*dive/)){
	  	$("body").fadeTo(400,0, function(){ location.href=href;});
	 	return false;
	 }else{
	  	return true;
 	}	
}

var kopf_skalieren = function(){

	var quality = imagequality;
	//if($(window).width() > 600){ quality = 90; }
	//if($(window).width() > 900){ quality = 80; }
	//if($(window).width() > 1200){ quality = 50; }

	// !Höhe Header
	if($("hgroup").length > 0){ 
		var h = $("hgroup").height();
		var h_view = $('body').data('hoehe');
		$('body').data('header_hoehe', h_view );
		
		h = (h_view/5)*4;
        $("header").css("height", h);	
		//var h_head_box = Math.round(h_view /3);
		//var t_head_box = h_head_box * -1;
		//$("head_box").css("height", h_head_box);
		//$("head_box").css("marginTop",h_head_box);
		 
		// Headline beim Ladevorgang zeigen
		//hgroup = $("hgroup").clone();
		/*$("body").prepend("<div class='container' id='preteaser'><div class='row'><section class='head_box'></section></div></div>");
		$("#preteaser").fadeTo(0,0);
		h = (h_view/5)*4;
		$("#preteaser .row").css("height", h);
		$("#preteaser .row").css("position", "relative");
		
		// tempHeadline fest pinnen
		var position = $("#preteaser").offset();
		$("#preteaser").css("position","absolute");
		$("#preteaser").css("top",0);
		$("#preteaser").css("left",position.left);
		
		$("#preteaser .row .head_box").prepend(hgroup);
		$("#preteaser").fadeTo(1000,1);*/
	};
	
	// Preloaded
	bildbreite = (Math.round(breite/100))*100;
	
	// hochauflösendes Bild
	var img = new Image();
	var h = (h_view/5)*4;
	img.src = url_kopfbild + "&w=" + bildbreite + "&h=" +h+ "&s=1&q="+quality + bg_position;
	img.onload = function() {

        var style= "background-image: url('"+url_waves+"'), url('" + this.src + "');  opacity: 0; background-position: left bottom, center " + $("header").data("position");
		$('header').attr('style', style);
		
       
        $("header").css("height", h);
		$('header').fadeTo(2000,1);
		
		$("#navbar").addClass("loaded");
       //$('#preteaser').fadeOut(1000);
  
    };
}

var teaser = (function() {
	
	return {
		init: function(){
			$(".overview article").each(function( index, ele ){
				var a = $(this).find("a").attr("href");
				if(a && a.match(/http/)){ 
					$(this).addClass("pointer");
					$(this).click(function(){ leave(a); }); 
				}
				
			});
		}
	}

}());

var galerie = (function() {

	var breite = $(window).width() -200;
	var hoehe =  $(window).height() -120;
	$('body').data('breite', breite);
	$('body').data('hoehe', hoehe);
	$('head').append('<link rel="stylesheet" href="'+template_url+'/struktur/lib/photoswipe-3.0.5/photoswipe.css" type="text/css" />');
	//$('head').append('<script src="'+template_url+'/struktur/lib/photoswipe-3.0.5/lib/klass.min.js" type="text/javascript"></script>');
	//$('head').append('<script src="'+template_url+'/struktur/lib/photoswipe-3.0.5/code.photoswipe.jquery-3.0.5.min.js" type="text/javascript"></script>');
	
	return {
		init: function(){
			$('#slideshow_carousel').carousel({ interval: 5000 });
			if($("#slideshow_carousel a").length > 0){
				$("#slideshow_carousel a").photoSwipe({  enableMouseWheel: false , captionAndToolbarAutoHideDelay: 0,  enableKeyboard: true, allowUserZoom: true, allowRotationOnUserZoom: true, slideSpeed: 1000, slideshowDelay: 5000 });	
				$("#slideshow_carousel a").addClass("slidelink");
			}
		},
		
		init_thumbnails: function(){
			$(".thumbnail").photoSwipe({  enableMouseWheel: false ,  enableKeyboard: true, allowUserZoom: true, allowRotationOnUserZoom: true, slideSpeed: 1000, slideshowDelay: 5000 });
			$(".thumbnail").addClass("slidelink");
		},
		
		init_gallery: function(){
			$("#photoswipe a").photoSwipe({  enableMouseWheel: false , captionAndToolbarAutoHideDelay: 0, enableKeyboard: true, allowUserZoom: true, allowRotationOnUserZoom: true, slideSpeed: 1000, slideshowDelay: 5000 });
			$("#photoswipe a").addClass("slidelink");
		}
	}

}());


var bubbles = (function() {
	
	/*abgestellt ss 20130313 wegen Arbeiten am BookingCal. TODO CN: Über der Kalendertabelle sollte die Bubblesfunktion nicht aktiv sein! */
	
	return {
		start: function(x_pos, y_pos){
			var bubble_src = template_url + "/struktur/img/dive_is_parallaxe_single_bubble.png";
			var w = $(window).width();
			var h = $(document).height();
			
			// bubbles setzen
			if(!x_pos) var x_pos = Math.floor(Math.random() * w) + 1;
			if(!y_pos) var y_pos = $(window).scrollTop() + $(window).height();
			var size = (Math.floor(Math.random() * 4) + 1) * 4;
			
			x_pos = x_pos + (Math.floor(Math.random() * 20) + 1);
			
			if(y_pos < $(window).height() || bubble_amount > 10){ return false; }
			
			var id = "bubble_" + bubble_count;
			var klasse = "s" + size;
			var add_klasse = "sa" + size;
			
			$("body").append("<img class='bubble "+klasse+"' id='"+id+"' src='"+bubble_src+"' />");
			$("#"+id).css("left", x_pos);
			$("#"+id).css("top", y_pos);
			$("#"+id).css("width", size);
			$("#"+id).click(function(e){
				$(this).addClass(add_klasse);
			});
			
			bubble_count++;
			setTimeout(function(){ 
				$("#"+id).addClass(add_klasse); 
				// $("#"+id).css("bottom", h); 
				$("#"+id).css("width", size*3); 
			}, 1);
			
		},
		
		init: function(){
			$(document).mousemove(function(e){ bubbles.start(e.pageX, e.pageY); });
			setInterval(bubbles.kill, 1000);
			bubbles_aktiv = true;
		},
		
		kill: function(){
			bubble_amount = 0;
			$(".bubble").each(function(){
				var o = $(this).offset();
				if(o.top <  $(window).scrollTop() || o.top >  $(window).scrollTop() + $(window).height() || o.top < $("header").height()){ $(this).fadeOut("slow").delay("2000").remove(); }
				else{ bubble_amount ++; }
				//$(this).fadeOut("slow").delay("2000").remove();;
				
			});
			
		}
	}
	

}());

/* Cforms säubern
--------------------------------- */

var forms = new Object();

forms.func= (function() {
	
	return {
		init: function(){
			// Forms sauber machen
			$(".cform [style]").each(function(){
				$(this).addClass("alert alert-info");
				$(this).removeAttr("style");
			});
			$(".linklove").remove();
			$("#usermessagea").html("All fields are required.");
			
			// Content etwas umsortieren
			$("#cformsform li").each(function(index, ele){
				var $this = $(this);
				var label = $this.find("label");
				var span = $this.find("span[class*='req']");
				$this.append(label);
				$this.append(span);
			});
			
			$("#cformsform fieldset ol").each(function(index, ele){
				var $this = $(this);				
				$this.addClass("row");
				
				// wie viele Elemente sind drin?
				var span = 12/ $this.find("li[id*='li']").length;
				$this.find("li").wrap("<div class='span"+span+"'></div>");
				
			});
			
			// Komische Erroranzeige killen
			//$("#cformsform ul[class*='_err']").remove();
			
			// Captcha umsortieren
			var captcha_reload = $("a[title*='captcha']");
			$(captcha_reload).parent().prepend(captcha_reload);
			
			var captcha = $("#cf_captcha_img");
			$(captcha).parent().prepend(captcha);
			
			// Sendbutton nett machen
			$("#cformsform #sendbutton").addClass("btn btn-inverse");
			//$("#cformsform #sendbutton").click(function(){ forms.func.init(); });
			
			
		}
	}
}());


// Google Analytics Events feuern für Modalboxes
	$('.bookingtracker').click(function(event) {
	url = $(location).attr('href');
	_gaq.push(['_trackEvent', 'Bookingform', 'Open', "'"+url+"'"]);
	});
	
	$('.contacttracker').click(function(event) {
	url = $(location).attr('href');
	_gaq.push(['_trackEvent', 'Contactform', 'Open', "'"+url+"'"]);
	});
	
	$('.booking .book_now_button').click(function(event) {
		if($(this).attr("value")== "Finish your booking and pay now"){
	url = $(location).attr('href');
	_gaq.push(['_trackEvent', 'Bookingform', 'Submit', "'"+url+"'"]);
		}
	});
		
	$('.cf-sb .sendbutton').click(function(event) {
	url = $(location).attr('href');
	_gaq.push(['_trackEvent', 'Contactform', 'Submit', "'"+url+"'"]);
	});

// !Tripadvisor
/*--------------------------------- */
var clean_tripadvisor = new Object();

clean_tripadvisor.func = (function() {
	
	return {
		init: function(){
			
			// Headline raus
			$("#TA_Link").remove();
			
			// Bootstrap table class dran und wir wollen ein händchen sehen
			$(".TA_rtable").addClass("table pointer");
			
			// Headline soll rot und eine h3 sein und wir wollen auf den ganzen eintrag klicken können
			$("a.TA_rname").addClass("rot").wrap("<h3 class='inline'></h3>").each(function(index, ele){ 
				var url = $(this).attr("href");
				$(this).closest("table").click(function(){ location.href=url; });
			});
			
			// schlechte Bewertungen raus
			$(".TA_rtable img[alt='3 of 5'], .TA_rtable img[alt='2 of 5'], .TA_rtable img[alt='1 of 5'], .TA_rtable img[alt='0 of 5']").each(function(index, ele){ 
				$(this).closest("table").remove();
			});
			
			$(".TA_rtable img[alt='5 of 5']").each(function(index, ele){ $(this).parent().append("<i class='rating five-star'></i>");$(this).remove();});
			$(".TA_rtable img[alt='4 of 5']").each(function(index, ele){ $(this).parent().append("<i class='rating four-star'></i>");$(this).remove();});
			
			// anderen Review Button rein
			$(".TA_rtable img[src*='writeAReview']").parent().append("<button class='btn btn-inverse'>Write a review</button>");
			$(".TA_rtable img[src*='writeAReview']").remove();
		}
	}
}());

/* Ready
================================= */
var bubble_count = 0;
var bubbles_aktiv = false;
var mouse_x = 0;
var bubble_amount = 0;
var breite = 0;
var hoehe = 0;
var check_imgs = new Object;
check_imgs.interval = false;
check_imgs.complete = 0;


/*head.ready(function() {

});*/



function km_booking_request_email(id,title,customfield,url){
	
	$('#myModalcontact').css("display","block");
	$('#subject').val(title);
	$('#myModalcontact').modal();

}

/* Dropdown Hauptmenü */
km_menu = {
    init: function(){
		
		// Adding the needed html to WordPress navigation menus //
		$("ul.dropdown-menu").parent().addClass("dropdown");
		$("ul.nav li.dropdown a").addClass("dropdown-toggle");
		//$("ul.dropdown-menu li a").removeClass("dropdown-toggle");
		$('a.dropdown-toggle').attr('data-toggle', 'km-menu');
	
        $('[data-toggle="km-menu"]').on('click',function(e){
            e.preventDefault();
			$(this).next('ul').stop().slideToggle().parent().toggleClass('show').siblings().removeClass('show').children('ul').stop().slideUp();
        });
        
        // Mobiles Zeug
        //$('div.nav-collapse').addClass('visible-desktop');
        if( $('#mobil_menu').length )
	         $('#mobil_menu > select')
			  	.on('change', function(){ location.href = this.value })
			  	.prop("selectedIndex", -1);
    }
}


/* zeigt das modale Fenster mit dem Kalender der ersten Resource */
function km_show_calendar(){ 

	//var htmlStr = $(".hasDatepick").html();

	$('#myModal').css("display","block");

	// Das hier ist das Kalendarium ss
	$(".hasDatepick").css("display","block");
	
	$('.booking_form_div').css("display","block");
	$('.km_orderform').css("display","none");
		
	$($('.km_booking_wrap')[0]).css("display","block");
	$($(".km_booking_tour_navi li")[0]).addClass("btn-danger");	
		
	// etwaige im Dom bestehende Pay-Forms entleeren, nicht entfernen, da es benötigt wird
	for(var i = 1; i <= 5;i++) {
		if($('#paypalbooking_form'+i)){
			//$('#paypalbooking_form'+1).remove();
			$('#paypalbooking_form'+i).text("");
			//$('#paypalbooking_form'+1).css("display","none");
		}
	}
	
	$('#myModal').modal();
}

/* Erlaubt den Wechsel zwischen den Resourcen per Klick im Modal */
function km_show_up_tour_calender(resourceid){
	$(".km_booking_wrap").css({'display' : 'none'});
	$(".km_booking_tour_navi li").removeClass("btn-danger");
	$("#km_booking_wrap"+resourceid).css({'display' : 'block'});
	$("#km_booking_tour_label"+resourceid).addClass("btn-danger");	
	$('#km-date-for-booking').remove();

	$('#calendar_booking'+resourceid).css({'display' : 'block'});
	
	var form = $($('#km_booking_wrap'+resourceid+' .km_orderform')[0]);
	form.css("display","none"); // Falls schon an, Bookginform abschalten
	
	$('#paypalbooking_form'+resourceid).text(""); // Entleeren des evt. gefuellten Paypal/Korta-bezahl-Divs		
	
}

/* User hat auf einen Tag im Kalendarium geklickt: Orderform erscheint, Kalendarium verschwindet ss*/
function km_fired_day_selection(td, id, timestamp){ 
	/*
	td
	id = #calendar_booking2
	timestamp
	*/
	
	resourceid = id.replace("#calendar_booking","");
	
	var km_participants = $(td).attr('data-content').match(/Available: (.*)$/)[1];
	var form = $($('#km_booking_wrap'+resourceid+' .km_orderform')[0]);
	var date = new Date(timestamp); // gebuchter Tag
	
	/*
	 * KM 
	 * 20140128 ms
	 * 
	 * - Überprüfen ob nach 17 Uhr für morgen gebucht wurde
    */
    var isOvertime='0';
    
    /*
     * KM
     * 06032014 ms
    */
    
    if(km_morgen.getDate()==date.getDate()&&km_morgen.getMonth()==date.getMonth()&&km_morgen.getYear()==km_morgen.getYear()) {    
        // per PHP zu überprüfen, ob die Uhrzeit stimmt ist sicherer, da JS clienseitig
        $.ajax({
            async: false, // damit das Formular nicht angezeigt wird
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {action: 'time_check'},
            success: function( data ) {
                console.log( data );
                isOvertime = data;
            }
        });
    } 
    
    console.log(isOvertime);
    if(isOvertime=='1') {
        alert('Unfortunately it is not possible to book a tour online after 5pm for the following day. It might however still be possible to come with us on tour tomorrow. Please give us a phone call at +(354) 578 6200.');
        return;   
    } else {
    	$('#km-date-for-booking').remove();
    	$('#km_booking_wrap'+resourceid).find("h3").html($('#km_booking_wrap'+resourceid).find("h3").text()+" <span id='km-date-for-booking'> Date: "+date.getDate()+"."+(date.getMonth()+1)+"."+date.getFullYear()+"</span>");
    	form.css("opacity", 0);
    	form.css("display","block");
    	form.delay(500).fadeTo("slow", 1);
    	
    	$('#booking_form_div'+resourceid).css("display","block");
    	
    	
    	//$('#km_booking_wrap'+resourceid+' .hasDatepick').css("display","none");
        $('#calendar_booking'+resourceid).css({'display' : 'none'});
    
        
        var options = '';	
    	for(var i = 1; i <= parseInt(km_participants);i++) {
    		options += '<option value="'+i+'">'+i+'</option>';
    	}
    	$('#km_booking_wrap'+resourceid+' .km_orderform select[name=visitors'+resourceid+']').html(options);
	}
}




/* Anpassen der Participants im Bookingform an die Besucheranzahl, Participants-Form-Elemente werden in den Booking-Settings im Menü Fields eingegeben  ss*/
function km_adjust_participants_form(resourceid){

	visitor_az = $('select[name^="visitors'+resourceid+'"] :selected').val(); 
	
	i = 1;
	
	/* Auf der Clienseite */
	var domel = $("#km_booking_wrap"+resourceid+" [data-participants]"); //$('#km_booking_wrap'+resourceid+' .km_participants');
	
	/* Auf der Adminseite */
	if(location.href.match(/admin.php/)){
		domel = $("#km_booking_wrap"+resourceid+" [data-participants");
	}
	
	domel.each(function(){		
			/*participants_number = (this.className.split("participants_"))[1];
			alert(this.participants_number); parseFloat(participants_number) */
			
			if( i <= visitor_az ){
				$(this).css("display","block");
			}
			else{
				$(this).css("display","none");
			}
			i++;
	});
	
}



$(window).load(function() {	
			
    km_menu.init();
    
	breite = $(window).width();		
	hoehe =  $(window).height();
	$('body').data('hoehe', hoehe);
	
	
	// Forms aufräumen
	forms.func.init();
	
	// Kontext
	if($(".visible-tablet").is(':visible')){ $("body").addClass("tablet"); $(".visible-tablet").remove(); display_mode = "tablet"; }
	if($(".visible-desktop").is(':visible')){ $("body").addClass("desktop"); $(".visible-desktop").remove();}
	if($(".visible-phone").is(':visible')){ 
		$("body").addClass("phone"); $(".visible-phone").remove();
		display_mode = "phone"; 
	}
	
	// Schönes einfaden
	//$('header').fadeTo(0, 0.01);
	kopf_skalieren();
			
	// sind die Bilder geladen?
	check_imgs.imgs = $("img");
	check_imgs.i_imgs = check_imgs.imgs.length;
	check_imgs.segmente = breite / check_imgs.i_imgs;
	check_imgs.interval = setInterval(imgs_complete, 100);

	// die schönen Bubbles
	if($(".home").length >0 && display_mode == "desktop"){
		bubbles.init();
		$(document).mousemove(function(e){ mouse_x = e.pageX; });
	}
	
	// Galerie initialisieren
	if($(".dive_slideshow").length > 0){ galerie.init("#slideshow_carousel"); }
	if($(".dive_gallery").length > 0){ galerie.init_gallery(); }
	if($(".dive_img_with_caption").length > 0){ galerie.init_gallery(); }
	
	// Tripadvisor aufräumen
	if($("#TA_Link").length > 0){ clean_tripadvisor.func.init(); }
	

	// !FAQ
	$(".FAQ dl").click(function(e){
	

		var ele = $(this);
		if(ele.hasClass("aktiv")){
			ele.removeClass("aktiv");
		}else{
			ele.addClass("aktiv");
		}
	});
	
	$(".rescale").each(function(){
		
		var obj = $(this);
		var src = this.src;

		// Lazy Loaded Images
		if(obj.attr("data-src")){ 
			src = obj.attr("data-src"); 
		}
			
		// Größe des (Eltern-) Objekts merken
		store_size( obj );
			
		if(src.match(/(.*?)\/src=(.*?)&(.*)/)){
			var query = new Array();
			query["imageserver"] = RegExp.$1;
			query["src"] = RegExp.$2;
			var qs = RegExp.$3;		
			$.each(qs.split(/&/), function(index, value) {
				var val = value.split(/=/);
				query[val[0]] = val[1];
			});

			//$(this).fadeTo(0.01);		
			// Lazy Loaded Images
			if(obj.attr("data-src")){ 
				obj.attr("data-src", rescale_images( query, obj )); 
			}else{
				this.src = rescale_images( query, obj );
			}
			
			
			//$(this).fadeIn();
			
		}
	});
	
	$('[style*="url"]').each(function(){
		var obj = $(this);
		var style = obj.attr("style");

		if(style.match(/.*url(.*?),.*\?(.*?)\/src=(.*?)&(.*)['|"]/)){
			var query = new Array();
			query["wobbel"] = RegExp.$1;
			query["imageserver"] = RegExp.$2;
			query["src"] = RegExp.$3;
			var qs = RegExp.$4;

			$.each(qs.split(/&/), function(index, value) {
				var val = value.split(/=/);
				query[val[0]] = val[1];
			});		
			
			var src_neu = rescale_images( query, obj );
			style = style.replace(/url(.*?)url\('.*?'\)/, "url" + query["wobbel"] + ",url('"+src_neu+"')");
			obj.attr("style", style);
		}
	});
	
	
	// !kleine Aktionen beim Scrolling
	if($(".phone").length == 0){

		var scroll = false;
		var st = $(window).scrollTop();
		var st_last = $(window).scrollTop();

		
		$(window).scroll(function() {
			if(bubbles_aktiv){ 
				if(mouse_x < $(window).width() -10){
					bubbles.start(mouse_x);
				}else{
					bubbles.start();
				}
			}
						
			scroll = true;
			st = $(window).scrollTop();
			//if(st < 400){

				var h = $('body').data('header_hoehe') - st;
				h = (h/5)*4;
				$("header").css("min-height",h);
				$("header").css("height",h);
	
			//}
	  	});
	}
	
	// Teaser komplett klickbar machen
	teaser.init();

	// Schönes Fading beim Klick auf Links
  	$("a:not(.slidelink)").click(function() {
  		var href = $(this).attr("href");
  		leave(href);	
	});
	
	// Bilder beim Scrolling nachladen
	$("img").unveil(50, function() {
		$(this).load(function() {
			$(this).addClass("loaded");
			if(this.src.match(/(.*?)\/src=(.*?)&(.*)/)){			
				var query = new Array();
				query["imageserver"] = RegExp.$1;
				query["src"] = RegExp.$2;
				var qs = RegExp.$3;
			
				$.each(qs.split(/&/), function(index, value) {
					var val = value.split(/=/);
					query[val[0]] = val[1];
				});
				
				rescale_images( query, $(this) );
			}
		});
	});
	
	
});