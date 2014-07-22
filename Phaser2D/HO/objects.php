<?php
$dir='res/items';
//$files = scandir($dir);
//$shuffle($files);
foreach (range(0, 10) as $n) {
    $files = glob($dir . '/*.png');
    $file = array_rand($files);
    $base = basename($files[$file]);
    $base = explode(".", $base);
    $name = $base[0];
    echo "'{\"name\":\"$name\",\"file\":\"$files[$file]\" },' +";
}

$files = glob($dir . '/*.png');
$file = array_rand($files);
$base = basename($files[$file]);
$base = explode(".", $base);
$name = $base[0];

echo "'{\"name\":\"$name\",\"file\":\"$files[$file]\" }]}'";
?>
