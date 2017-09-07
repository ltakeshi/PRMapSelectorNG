<?php
require_once "vendor/autoload.php";

$loader = new Twig_Loader_Filesystem("layout/");
$twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
$twig->addExtension(new Twig_Extension_Debug());


$Maps = Spyc::YAMLLoad('yaml/pr_maps.yaml');
$keys = array_keys($Maps);
$mapids_mapnames = array();

foreach($keys as $key){
    $mapids_mapnames[$key]['mapid'] = $key;
    $mapids_mapnames[$key]['mapname'] = $Maps[$key]['name'];
    $mapids_mapnames[$key]['mapsize'] = $Maps[$key]['mapsize'];

    if ((in_array(1,$Maps[$key]['rules'],true)) or (in_array(2,$Maps[$key]['rules'],true)) or (in_array(3,$Maps[$key]['rules'],true)) or (in_array(4,$Maps[$key]['rules'],true)) ) {
        $mapids_mapnames[$key]['AAS'] = "AAS";
    }
    if ((in_array(5,$Maps[$key]['rules'],true)) or (in_array(6,$Maps[$key]['rules'],true)) or (in_array(7,$Maps[$key]['rules'],true)) or (in_array(8,$Maps[$key]['rules'],true)) ) {
        $mapids_mapnames[$key]['INS'] = "INS";
    }
    if ((in_array(9,$Maps[$key]['rules'],true)) or (in_array(10,$Maps[$key]['rules'],true)) or (in_array(11,$Maps[$key]['rules'],true)) or (in_array(12,$Maps[$key]['rules'],true)) ) {
        $mapids_mapnames[$key]['C'] = "C";
    }
    
}


$page = array(
    "maps" => $mapids_mapnames,
    "key" => array_keys($Maps),
);


$template = $twig->load("index.html.twig"); 
$template->display($page);

?>