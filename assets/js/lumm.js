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
		$( "#twitterfeed" ).load( "/assets/php/twitter/twitter.php" );
		return true;
	}
      	
	// öffentliche Funktionen und init
	exports.init = function(){
		return get_tweets();
	};
	
	// öffentliche Funktionen bekanntgeben
	return exports;
})();





/* Main
------------------------------------------------------*/

$(document).ready(function () {
	
	// Fire the init actions
	while( init_actions.length ){ eval( init_actions.shift() ); }
	
	
});