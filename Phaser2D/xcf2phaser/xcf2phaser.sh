#!/bin/bash

mkdir res
mkdir js

cat > level.html <<EOH
<!doctype html>
<html lang="en">
<head> 
<!--
Created with xcf2phaser
http://filmsbykris.com

code can be found at:
https://github.com/metalx1000/Game-Basics

-->
    <meta charset="UTF-8" />
    <title>Phaser - Game</title>
    <script type="text/javascript" src="js/phaser.min.js"></script>
    <style type="text/css">
        body {
            margin: 0;
        }
    </style>
</head>
<body>

<script type="text/javascript">
var height = 600;
var width = 800

var game = new Phaser.Game(width, height, Phaser.AUTO, '', { preload: preload, create: create, update: update });

function preload() {


EOH

list="$(xcfinfo "$1"|grep Normal|sed 's/ RGB-alpha Normal /|/g'|sed 's/+ //g'|tr "\n" "?")"
IFS="?" read -a array <<< "$list"

rm preload.tmp


#cat > image.tmp <<EOI 
#    //platforms group 
#    platforms = game.add.group();
#
#    //Enable physics for platform group
#    platforms.enableBody = true;
#
#EOI 

for i in "${!array[@]}"
do    
    crop="$(echo "${array[i]}"|cut -d\| -f1)"
    size="$(echo "${array[i]}"|cut -d\| -f1|sed -e "s/-/+/" -e "s/+/|/"|cut -d\| -f1)"
    pos="$(echo "${array[i]}"|cut -d\| -f1|sed "s/$size//g")"
    name="$(echo "${array[i]}"|cut -d\| -f2)"

    xcf2png "$1" "$name" > "res/${name}.png"
    convert "res/${name}.png" -crop $crop "res/${name}.png"
    echo "$name is $size and is at $pos"

#    echo "    game.load.image('$name', 'res/${name}.png');"  >> preload.tmp
#    echo "    platforms.create(, top, 'ground');    
done

rm *.tmp
