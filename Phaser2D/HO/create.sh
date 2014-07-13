#!/bin/bash

rm preload.tmp
rm load.tmp
rm ho.js
clear
#create items
for i in res/items/*.png
do 
    file="$i"
    name="$(basename $i)"

    echo "game.load.image('$name', '$file');" >> preload.tmp

    echo "items.push(game.add.sprite(game.rnd.integerInRange(100, width - 100), game.rnd.integerInRange(100, height - 100), '$name'));" >> load.tmp
done

echo "function pl(){" > ho.js
cat "preload.tmp" >> ho.js
echo "}" >> ho.js

echo "function l(){" >> ho.js
cat "load.tmp" >> ho.js
echo "}" >> ho.js

#clean up
rm preload.tmp
rm load.tmp

