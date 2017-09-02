<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
      <title>PRMapSelectorNG</title>
      <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

      <link rel="stylesheet" href="pr_map_selector.css">

      </head>
      <body>
      <h1>先行試作型PRMapSelectorNG</h1>
	<div class="filters">

	  <div class="ui-group">
	    <h3>マップサイズ</h3>
	    <div class="button-group filters-button-group" data-filter-group="map_size">
             <button class="button is-checked" data-filter="*">全て</button>
             <button class="button" data-filter=".1km">1km</button>
             <button class="button" data-filter=".2km">2km</button>
             <button class="button" data-filter=".4km">4km</button>
             <button class="button" data-filter=".8km">8km</button>
	    </div>
	  </div>

	  <div class="ui-group">
	    <h3>ゲームモード</h3>
	    <div class="button-group filters-button-group" data-filter-group="game_mode">
              <button class="button is-checked" data-filter="*">全て</button>
              <button class="button" data-filter=".AAS">AAS</button>
              <button class="button" data-filter=".INS">INS</button>
              <button class="button" data-filter=".C">C&amp;C</button>
	    </div>
	  </div>

	  <br>

	  </div> <!-- end filters -->

<hr />

<form action="select.php" method="post">
   <input type="hidden" name="" />
   <input type="submit" name="commit" value="ルールを選択する" />
                                                                
<hr />
<div class="grid">
  
<?php
require_once "lib/Spyc.php";

$Maps = Spyc::YAMLLoad('yaml/pr_maps.yaml');
$Rules = Spyc::YAMLLoad('yaml/pr_rules.yaml');

foreach ($Maps as $key => $val){
    print '<label for="map_'.$key.'">';
    print '<div class="element-item nbox';
    print ' '.$Maps[$key][mapsize].'km';
    if ( (in_array(1, $val[rules],true)) or (in_array(2, $val[rules],true)) or (in_array(3, $val[rules],true)) or (in_array(4, $val[rules],true)) ) {
        echo ' AAS';
    }

    if ( (in_array(5, $val[rules],true)) or (in_array(6, $val[rules],true)) or (in_array(7, $val[rules],true)) or (in_array(8, $val[rules],true)) ) {
        echo ' INS';
    }
    
    if ( (in_array(9, $val[rules],true)) or (in_array(10, $val[rules],true)) or (in_array(11, $val[rules],true)) or (in_array(12, $val[rules],true)) ) {
        echo ' C';
    }    
    print '">';
    print '<img src="img/'.$key.'.jpg" alt="'.$Maps[$key][name].'"  />';
    print '    <input type="checkbox" value="1" name="map['.$key.']" id="map_'.$key.'" />';
    print ''.($Maps[$key][name]).'';
    print '</div>';
    print '</label>';
}

?>

    </div>
  </form>
  <script src="js/main.js"></script>
  </body>
</html>