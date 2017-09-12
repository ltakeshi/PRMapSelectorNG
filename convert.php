<?php
$pngdir = __DIR__.'/png';
$tmpdir = __DIR__.'/tmp';
$jpgdir = __DIR__.'/jpg';

mkdir_exists($tmpdir);
mkdir_exists($jpgdir);
$pngfilelist = (array_map(function ($v) { return basename ($v,'.png'); } ,getFileList($pngdir)));

foreach ($pngfilelist as $file){
    file_copy($file,$pngdir,$tmpdir);
}

$ddsfilelist = (array_map(function ($v) { return basename ($v,'.dds'); } ,getFileList($tmpdir)));

#print_r($ddsfilelist);

foreach ($ddsfilelist as $file){
    dds2jpg($file,$tmpdir,$jpgdir);
}

rmrf($tmpdir);


function dds2jpg($name,$tmpdir,$jpgdir){
    system('/usr/bin/convert '.$tmpdir.'/'.$name.'.dds '.$jpgdir.'/'.$name.'.jpg');
    echo $name.".jpgに変換完了<br />\n";
}


function getFileList($dir) {
    $files = glob(rtrim($dir, '/') . '/{*.png,*.dds,*.jpg}',GLOB_BRACE);
    $list = array();
    foreach ($files as $file) {
        if (is_file($file)) {
            $list[] = $file;
        }
        if (is_dir($file)) {
            $list = array_merge($list, getFileList($file));
        }
    }
    return $list;
}

function trimnum($name){
    $pattern = array('/_\d_/');
    $string = str_replace('_','',preg_replace($pattern,'',$name,1));
    return $string;
}

function file_copy($name,$pngdir,$tmpdir){
    $file = $pngdir.'/'.$name.'.png';
    $newfilename = trimnum ( basename ($name));
    $newfile = $tmpdir.'/'.$newfilename.'.dds';

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

function rmrf($dir) {
    if (is_dir($dir) and !is_link($dir)) {
        array_map('rmrf',   glob($dir.'/*', GLOB_ONLYDIR));
        array_map('unlink', glob($dir.'/*'));
        rmdir($dir);
    }
}



?>