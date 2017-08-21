<?php

/* kleines Vorschaltscript für timthumb.php, damit Ladevorgang und Caching noch optimiert werden können.
04.2013 c.noss@klickmeister.de */

# wo liegt timthumb
$timthumb = "/assets/php/timthumb/timthumb.php";

# Urls lesen und zurecht schneiden
$script = $_SERVER["SCRIPT_NAME"];
$server = $_SERVER["SERVER_NAME"];
$url = $_SERVER['REQUEST_URI'];

$path_to_root = realpath( dirname(__FILE__).'/../../../' );
$path = parse_url($_GET['src'], PHP_URL_PATH);

#$query = $_SERVER['QUERY_STRING'];

$query = $url;
$query = preg_replace("=.*?src\=http://.*?/=", "src=/", $query);

$query = str_replace(";", "&", $query);
$query = str_replace("%3b", "&", $query);
parse_str($query);
if(!isset($q)){ $q=95; }


header("Location: http://$server$timthumb?$query");
exit;

#print "http://$server$timthumb?$query"; exit;

# Bild holen

#print "$path_to_root$path"; exit;
$img = imagecreatefromstring(file_get_contents("http://$server$timthumb?$query"));
#$img = imagecreatefromstring(file_get_contents("$path_to_root$path"));


# Interlace aktvieren
//imageinterlace ( $img, 1 );

# Cache Control setzen und ausliefern
header('Content-Type: image/jpeg');
header("Cache-Control: max-age=3600, must-revalidate"); // HTTP/1.1
$offset = 48 * 60 * 60;
$expire = "expires: " . gmdate ("D, d M Y H:i:s", time() + $offset) . " GMT";
header ($expire);
imagejpeg($img, NULL, $q);
imagedestroy($img);

?>