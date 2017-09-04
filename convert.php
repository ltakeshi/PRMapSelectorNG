<?php

require_once "lib/Spyc.php";
$Maps = Spyc::YAMLLoad('yaml/pr_maps.yaml');
$tmp_directory_path = "tmp";
$img_directory_path = "img";

function file_copy($name){
    $file = 'png/'.$name.'.png';
    $newfile = 'tmp/'.$name.'.dds';
    
    if (!copy($file, $newfile)) {
#        echo "failed to copy $file...<br />\n";
    }
}

function mkdir_exists($dir){
    if(file_exists($dir)){
#        echo "作成しようとしたディレクトリは既に存在します<br />\n";
    }else{
        if(mkdir($dir, 0777)){
            chmod($dir, 0777);
#            echo "作成に成功しました<br />\n";
        }else{
#            echo "作成に失敗しました<br />\n";
        }
    }
}

function dds2jpg($name){
    system('/usr/bin/convert tmp/'.$name.'.dds img/'.$name.'.jpg');
    echo $name.".jpgに変換完了<br />\n";
}

function rmrf($dir) {
    if (is_dir($dir) and !is_link($dir)) {
        array_map('rmrf',   glob($dir.'/*', GLOB_ONLYDIR));
        array_map('unlink', glob($dir.'/*'));
        rmdir($dir);
    }
}

mkdir_exists($tmp_directory_path);
mkdir_exists($img_directory_path);

foreach ($Maps as $key => $val){
    file_copy($key);
    dds2jpg($key);
}

rmrf($tmp_directory_path);

?>