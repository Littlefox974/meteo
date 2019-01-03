
<?php

header('Content-Type: text/html; charset=ISO-8859-1');

$opts = array('http' => array('proxy'=> 'tcp://www-cache.iutnc.univ-lorraine.fr:3128', 'request_fulluri'=> true));

$context = stream_context_create($opts); 

$strGPS_content = file_get_contents('http://ip-api.com/xml', NULL, $context);

$strGPS = simplexml_load_string($strGPS_content);

//$url = "http://www.infoclimat.fr/public-api/gfs/xml?_ll=" . $strGPS->lat .",". $strGPS->lon. "&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2";
$url = "http://www.infoclimat.fr/public-api/gfs/xml?_ll=48.6921,6.18442&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2";
$xml_content = file_get_contents($url, NULL, $context);

/*function ip(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

$ipData = file_get_contents("http://ip-api.com/$ip",false,$context);
var_dump(json_decode($ipData));*/



$html = "<!doctype html>
<html lang=\"fr\">
<head>
  <meta charset=\"utf-8\">
  <title>dechiffrage du json Nantes</title>
  <link rel='stylesheet' href='style.css'>
<link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.3.4/dist/leaflet.css\"
   integrity=\"sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==\"
   crossorigin=\"\"/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src=\"https://unpkg.com/leaflet@1.3.4/dist/leaflet.js\"
   integrity=\"sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==\"
   crossorigin=\"\"></script>

</head>
<body>



 <div id=\"mapid\"></div>






  <script>
  
  var mymap = L.map('mapid').setView([48.6912,6.1838], 12);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
        '<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, ' +
        'Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',
    id: 'mapbox.streets'
}).addTo(mymap);
  
  
</script>
  
</body>
</html>

";
echo $html;
//Donnee meteo
// Chargement du source XML


$xml = new DOMDocument;
$xml->loadXML($xml_content);

$xsl = new DOMDocument;
$xsl->load('meteo.xsl');

// Configuration du transformateur
$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl); // attachement des règles xsl

echo $proc->transformToXML($xml);

//Donnees velo
$url_velo = "http://www.velostanlib.fr/service/carto";
$xml_velo =  new DOMDocument;
$xml_content_velo = file_get_contents($url_velo, NULL, $context);
$xml_velo->loadXML($xml_content_velo);

$xsl_velo = new DOMDocument;
$xsl_velo->load('velo.xsl');
$proc_velo = new XSLTProcessor;
$proc_velo->importStyleSheet($xsl_velo);
echo $proc_velo->transformToXML($xml_velo);









//%carte%
//str_replace
//http://localhost/cours_interoperabilite/meteo/script.php


