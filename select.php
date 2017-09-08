<?php
require_once "vendor/autoload.php";

$loader = new Twig_Loader_Filesystem("layout/");
$twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
$twig->addExtension(new Twig_Extension_Debug());


$Maps = Spyc::YAMLLoad('yaml/pr_maps.yaml');
$Rules = Spyc::YAMLLoad('yaml/pr_rules.yaml');
$mapids_names_rules = array();


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $postdata = $_POST;
}
$keys = array_keys($postdata['map']);
$mapids_names_rules = array();


foreach($keys as $key){
    $i=0;
    $mapids_names_rules[$key]['mapid'] = $key;
    $mapids_names_rules[$key]['mapname'] = $Maps[$key]['name'];
    foreach ($Maps[$key]['rules'] as $rule){
    $mapids_names_rules[$key]['rules'][$i]  = $Rules[$rule];
    $i++;
    }
        
}

$page = array(
    "datas" => $mapids_names_rules,
);



$template = $twig->load("select.html.twig");
$template->display($page);


?>