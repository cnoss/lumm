<?php 
/** Die Klasse einbinden **/
require_once("../../lib/twitter-api-php/TwitterAPIExchange.php"); 

/** Hier kommen die Codes der APP rein **/ 
$settings = array(
	'oauth_access_token' 			=> "22971416-p2LsnnlaECyQFfubPwkgqFeIp7N1IFoavNyhDwms0",
	'oauth_access_token_secret' 	=> "UZN7ZORo45MJnX9wH90JMuSD4mEHAeyEbHvxnXZxRWrjR",
	'consumer_key' 					=> "WX2nNMQrDZ6bIHGmRdX2KoTAi",
	'consumer_secret' 				=> "tBKOdfCrjkLz5lVWYVbtecUOobpf0nCHOB4KYPWpWS3rPxoN7u"
);

# konvertiert rfc timstamp zu unix ts
function convert_date($date) {
	$months=array();
	for($x=0;$x<12;$x++) {
		$months[$x]=date("M",mktime(0,0,0,$x,1,2000));
	}
	#Sun Jan 20 20:18:25 +0000 2013
	list($day_name,$month,$day,$date,$timecode,$year) = explode(' ', $date);
	$month=array_search($month,$months);
	return date("d.m.Y",mktime(0,0,0,$month,$day,$year))." - ". preg_replace("=:..$=", "", $date);
}


function autolink($str, $attributes=array()) {
	$attrs = '';
	foreach ($attributes as $attribute => $value) $attrs .= " {$attribute}=\"{$value}\"";
	$str = ' ' . $str;
	$str = preg_replace('`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i','$1<a href="$2"'.$attrs.'>$2</a>',$str);
	$str = substr($str, 1);
	$str = preg_replace('`href=\"www`','href="http://www',$str);
	return $str;
}

/* Get Params
################################### */
$class = "tweet__standard";
if(isset($_GET["class"])){ $class = $_GET["class"]; }

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name=cnoss&count=5';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$result=json_decode($response, true);
foreach($result as $item){	
	print '<div class="'.$class.'">'. autolink($item["text"]). "<time>".convert_date($item["created_at"]).'</time></div>';
}
?>