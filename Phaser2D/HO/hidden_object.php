<!doctype html>
<html>
<head>
    <script src="js/phaser.min.js"></script>
    <style>
        body{margin:0}
    </style>
<!--    <script src="ho.js"></script>-->
    <script type="text/javascript">
        var height = 720;
        var width = 1280;
        var group;
        var items_total;

        var items = [];
        var game = new Phaser.Game(width,height,Phaser.CANVAS,"",{preload:preload, create:create});

        var objects = '{"obj":[' + <?php include('objects.php');?>;
        var obj = JSON.parse(objects);

        var obj_num = 10;
            
        var objs = game.add.group();

        // THE GAME IS PRELOADING
        function preload() {
            //images
            game.load.image("BG", "res/bg.png");
            game.load.image("WIN", "res/win.png");

            //items
            for(var i = 0;i<obj.obj.length;i++){
                game.load.image(obj.obj[i].name, obj.obj[i].file);
            }

            //sounds
            game.load.audio('chime', 'res/chime.wav');
            game.load.audio('win', 'res/win.wav');
        }
        
        // THE GAME HAS BEEN CREATED
        function create() {
            //add background
            game.add.sprite(0, 0, 'BG');

            //font style
            var style = { font: "25px Arial", fill: "white", align: "left" };

            //load items
            load_objects();

            var text_y = 15;
            for(var i = 0; i < items.length;i++){
                items[i].inputEnabled = true;
                items[i].events.onInputDown.add(item_click, this);
                var name = obj.obj[i].name;
                items[i].text = game.add.text(10, text_y, name, style);
                text_y += 20;
            }

            items_total = items.length;
            //Go Full Screen when Game Window Clicked  
            game.input.onDown.add(gofull, this);
            
        }


        function item_click(item){
            chime = game.add.audio('chime');
            chime.play();
            item.kill();
            item.text.visible = false;
            
            items_total -= 1;
            if(items_total == 0){
                win = game.add.audio('win');
                win.play();
                var win_text = game.add.sprite(width/2-200,height/2-200, 'WIN');
                win_text.scale.setTo(2, 2);
                console.log("you win");
            }
        }

        function gofull(){
            //Set the game to strech and fill the screen
            //game.scale.fullScreenScaleMode = Phaser.ScaleManager.EXACT_FIT;
            game.scale.fullScreenScaleMode = Phaser.ScaleManager.SHOW_ALL;
            game.scale.startFullScreen();
        }

        function load_objects(){
            for(var i = 0;i<obj.obj.length;i++){
                items.push(game.add.sprite
                    (game.rnd.integerInRange(100, width - 200), 
                    game.rnd.integerInRange(100, height - 200), 
                    obj.obj[i].name));
            }
        }
</script>
</head>
<body>
</body>
</html>
