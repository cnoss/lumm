<footer class="container">
	<div class="row">
		<div class="col-md-4">
			<?php
			snippet(get_organism("site--content--adresse"));
			?>
		</div>
		<div class="col-md-4">
			<?php
			snippet(get_organism("site--content--kontakt"));
			?>
		</div>
			<div class="col-md-4">
			<?php
			snippet(get_organism("site--content--social"));
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="copyright">

				<p><?php echo $site->copyright() ?>
				 // <a href="http://christiannoss.de/de/sonstiges/impressum">Impressum</a> // <a href="http://christiannoss.de/de/sonstiges/datenschutzerklaerung">Datenschutz</a>
				</p>
			</div>
		</div>

	</div>
</footer>


<!-- Zum detektieren des Anzeigemodus -->
<div class="detect visible-xs-block"></div><div class="detect visible-sm-block"></div><div class="detect visible-md-block"></div><div class="detect visible-lg-block"></div>

<!-- Weniger wichtiges CSS laden wir asynchron nach, damit die Seite schneller ausgeliefert werden kann. -->
<script type="text/javascript">
	/*!
	loadCSS: load a CSS file asynchronously.
	[c]2014 @scottjehl, Filament Group, Inc.
	Licensed MIT
	*/
	function loadCSS( href, before, media ){
		"use strict";
		// Arguments explained:
		// `href` is the URL for your CSS file.
		// `before` optionally defines the element we'll use as a reference for injecting our <link>
		// By default, `before` uses the first <script> element in the page.
		// However, since the order in which stylesheets are referenced matters, you might need a more specific location in your document.
		// If so, pass a different reference element to the `before` argument and it'll insert before that instead
		// note: `insertBefore` is used instead of `appendChild`, for safety re: http://www.paulirish.com/2011/surefire-dom-element-insertion/
		var ss = window.document.createElement( "link" );
		var ref = before || window.document.getElementsByTagName( "script" )[ 0 ];
		var sheets = window.document.styleSheets;
		ss.rel = "stylesheet";
		ss.href = href;
		
		// temporarily, set media to something non-matching to ensure it'll fetch without blocking render
		ss.media = "only x";
		// inject link
		ref.parentNode.insertBefore( ss, ref );
		// This function sets the link's media back to `all` so that the stylesheet applies once it loads
		// It is designed to poll until document.styleSheets includes the new sheet.
		function toggleMedia(){
			var defined;
			for( var i = 0; i < sheets.length; i++ ){
				if( sheets[ i ].href && sheets[ i ].href.indexOf( href ) > -1 ){
					defined = true;
				}
			}
			if( defined ){
				ss.media = media || "all";
			}
			else {
				setTimeout( toggleMedia );
			}
		}
		toggleMedia();
		return ss;
	}
  loadCSS('/assets/css/main-css.min.css');
  loadCSS('http://fast.fonts.net/cssapi/623ba3ce-fb0b-4a1a-844a-15c8a59662f9.css');
  
  
</script>
<noscript>
	<!-- Let's not assume anything -->
	<link rel="stylesheet" href="/assets/css/main-css.min.css">
</noscript>
<script type="text/javascript">
	// Picture element HTML5 shiv
	document.createElement( "picture" );
</script>

<script type="text/javascript" src="/min/g=js"></script>
<!--script data-position="topright" id="rwbanner" src="http://refugeeswelcome.github.io/banner/script.js"></script-->
</body>

<script type="text/javascript">
    var feed = new Instafeed({
        get: 'user',
        clientId: 'a45953a0f38c4da580f58fc200ac94dc',
        template: '<a class="animation" href="{{link}}"><img src="{{image}}" /></a>'
    });
    feed.run();
</script>
</html>