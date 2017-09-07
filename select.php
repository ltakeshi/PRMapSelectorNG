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
  <form action="result.php" method="post">
    <input type="hidden" name="" />
    <input type="submit" name="commit" value="ルールを選択する" />
    <div class="grid">

      <?php
      require_once "vendor/autoload.php";

      $Maps = Spyc::YAMLLoad('yaml/pr_maps.yaml');
      $Rules = Spyc::YAMLLoad('yaml/pr_rules.yaml');

      $data = $_POST['map'];


      foreach ( array_keys($data) as $key ){
        print '<label for="map_'.$key.'">';
        print '<div class="element-item nbox">';
        print '<img src="img/'.$key.'.jpg" alt="'.$Maps[$key]['name'].'" width="240" height="135" />';
        print ''.($Maps[$key]['name']).'';
        print '<br />';
        print '<select name="map[]">';

        foreach( $Maps[$key]['rules'] as $num ){
          print '<option value="'.$Maps[$key]['name'].' : '.$Rules[$num].'">'.$Rules[$num].'</option>';
        }

        print '</select>';
        print '</div>';
        print '</label>';
      }
      ?>
    </div>
  </form>
  <script src="js/main.js"></script>
</bod>
</html>
