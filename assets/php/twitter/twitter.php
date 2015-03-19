<?php 
/** Die Klasse einbinden **/
require_once("../../lib/twitter-api-php/TwitterAPIExchange.php"); 
include_once('../../../config/custom-config.php');

/** Hier kommen die Codes der APP rein **/ 
$settings = $custom_config["twitter_data"];

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
$class = "col-md-6";
if(isset($_GET["class"])){ $class = $_GET["class"]; }

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$settings["screen_name"].'&count='.$settings["shown_items"];
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$result=json_decode($response, true);

if(sizeof($result) > 0):
	foreach($result as $item): ?>

<div class="<?php echo $class; ?>">
	<div class="tweet">
		<p class="tweet__body"><?php echo autolink($item["text"]); ?></p>
		<div class="tweet__foot">
			<time class="time"><?php echo convert_date($item["created_at"]); ?></time>
			<div class="interaction-bar">
				<a class="btn btn-default interaction-bar__item" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $item["id"]; ?>"><span>t</span><span class="show-on-hover">weet</span></a>
				<a class="btn btn-default interaction-bar__item" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $item["id"]; ?>"><span>r</span><span class="show-on-hover">etweet</span></a>
				<a class="btn btn-default interaction-bar__item" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $item["id"]; ?>"><span>s</span><span class="show-on-hover">tar</span></a>
			</div>
		</div>
	</div>
</div>

<?php 
	endforeach; 
endif;
?>