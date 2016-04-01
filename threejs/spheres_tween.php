<html>
  <body>
    <script src="three.min.js"></script>
    <script src="TrackballControls.js"></script>
    <script src="tween.min.js"></script>

    <script>
      var camera, controls, scene, renderer;
      var spheres=[];
      var colors=["blue","green","red","pink","orange","yellow"];
      var angularSpeed = 0.2;
      var lastTime = 0;
      init();

      function init(){      
        renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);
        
        camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 5000);
        camera.position.y = -400;
        camera.position.z = 400;
        camera.rotation.x = .70;
        controls = new THREE.TrackballControls( camera );
   
        window.addEventListener( 'resize', onWindowResize, false );
        scene = new THREE.Scene();
       
        setInterval(newSphere,1000);
 
        var light = new THREE.DirectionalLight('white', 1);
        light.position.set(0,-400,400).normalize();
        scene.add(light);
 
        var light = new THREE.DirectionalLight('white', .3);
        light.position.set(0,400,-400).normalize();
        scene.add(light);
       
        animate();
      }

      function animate(){
        var time = (new Date()).getTime();
        var timeDiff = time - lastTime;
        var angularChange = angularSpeed * timeDiff * 2 * Math.PI / 1000;
        lastTime = time;
        controls.update();      
   
        TWEEN.update(); 
        requestAnimationFrame(function(){
            animate();
            render();
        });
      }

      function render(){
        renderer.render( scene, camera );
      }

      function newSphere(){
        var color = colors[spheres.length];
        var sphere = new THREE.Mesh(new THREE.SphereGeometry(100,31,31), new THREE.MeshLambertMaterial({
            color: color,
        }));
     
        //check if number is odd
        if(Math.abs(spheres.length % 2) == 1){
          var d = 100;
        }else{
          var d = -100;
        } 
        sphere.position.x = spheres.length * d; 
        spheres.push(sphere); 
        scene.add(sphere);
        var tween = new TWEEN.Tween({s: 0})
          .to({ s: 2}, 2000)
          .easing( TWEEN.Easing.Bounce.Out)
          .onUpdate(function(){
            sphere.scale.x = this.s ;  
            sphere.scale.y = this.s ;  
            sphere.scale.z = this.s ;  
        }).start();       
         
      }

      function onWindowResize() {
        windowHalfX = window.innerWidth / 2;
        windowHalfY = window.innerHeight / 2;
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize( window.innerWidth, window.innerHeight );
      }
    </script>
  </body>
</html>
