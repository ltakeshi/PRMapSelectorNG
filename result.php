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


  <?php
  foreach ($_POST['map'] as $val){
    print $val.'<br />';
  }

  ?>

</body>
</html>
