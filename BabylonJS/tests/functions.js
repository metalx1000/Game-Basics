function HUD_FPS(){
    var html = document.getElementById("fps");
    var fps = BABYLON.Tools.GetFps().toFixed() + " fps<br>";
    var meshes = x + " Meshes";
    html.innerHTML = fps + meshes;

}

var jump = 0;
function main_timer(physics){
    var grav_time = setInterval(function(){

        Load_Meshes(physics);

        if(jump > 0){
            jump -= 1;
            camera.cameraDirection.y = jump * 0.1;
        }else{
            camera.cameraDirection.y = -0.5;
        }
    },50);

}

var x = 1;
function Load_Meshes(physics){
    x += 1 ;
    var meshclone = mesh.clone("mesh " + x);
    meshclone.position.x = Math.random() * 200 - 100;
    meshclone.position.y = Math.random() * 200 - 100;
    meshclone.position.z = Math.random() * 200 - 100;
    if(physics == true && impostor == "box"){
        meshclone.setPhysicsState({ impostor: BABYLON.PhysicsEngine.BoxImpostor, mass: 1, friction: 0.5, restitution: 0.7 }); 
    }else if(physics == true && impostor == "sphere"){
        meshclone.setPhysicsState({ impostor: BABYLON.PhysicsEngine.SphereImpostor, mass: 1, friction: 0.5, restitution: 0.7 }); 
    }
    document.title = x + " Meshes";
    
    if(x % 50 == 0){
        var html = document.getElementById("info");
        var fps = BABYLON.Tools.GetFps().toFixed() + " fps with ";
        var meshes = x + " Meshes<br>";
        html.innerHTML += fps + meshes;
    } 

}


