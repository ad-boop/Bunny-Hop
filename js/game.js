// creation of the bunny hop game in the canvas

// canvas 
const canvas = document.getElementById('game'); 
// context 2d game
const context = canvas.getContext('2d'); 


/* Variables needed for the game */

// variable for the score
let score;
// the request for the animation to take  place
let request;
// the player which is the bunny
let player;
// the gravity controlling the bunny's hop
let gravity;
// array of obstacles in the game
let obstacles = [];
// the game speed
let gameSpeed;
// keys from the keyboard 
let keys = {};


// Event Listeners for the keys

// if  keyboard key is pressed
document.addEventListener('keydown', function (evt) { 
    keys[evt.code] = true; //keep track which keys are hold down.
});

// if the keyboard is not pressed
document.addEventListener('keyup', function (evt) {
    keys[evt.code] = false;
});




//class for the player character, which the user controls
class BunnyPlayer {

  constructor (xPos, yPos, width, height) {
        this.xPos = xPos; // x position
        this.yPos = yPos; // y position
        this.width = width; // width
        this.height = height; // height


        // jump velocity
        this.dy = 0; 
        // the force of the jump
        this.jumpForce = 13; 
        // for shrinking our character
        this.originalHeight = height; 
        // player on the ground
        this.grounded = false;
        // how long the jump will be
        this.jumpTimer = 0; 
    }


    // animate function for making the character jump or duck
    AnimatePlayer () { 

        if (keys['Space']||keys['ArrowUp']) { // Jump
            this.Jump();
        } 
        else {
            //time of jump is 0 , no change
            this.jumpTimer = 0; 
        }

        
        if (keys['ArrowDown'] || keys['ShiftLeft']) { //Duck
            // decrease the height of the character by minus 25
            this.height= this.originalHeight-22; 
        } 
        else {
            // same height no change
            this.height= this.originalHeight; 
        }

        this.yPos += this.dy;

        // Gravity
        if (this.yPos + this.height< canvas.height) {
            this.dy += gravity;
            this.grounded = false;
        } 
        else {
            this.dy = 0;
            this.grounded = true;
            this.yPos = canvas.height - this.height;
        }

        this.Draw("bunnyPlayer"); // draw the character
    }

    Jump () {
        
        // if the character is touching the ground
        if (this.grounded && this.jumpTimer == 0) { 
            this.jumpTimer = 1;
            this.dy = -this.jumpForce;
            // 13 max height for jumping
        } 
        else if (this.jumpTimer > 0 && this.jumpTimer < 30) {
            // incrementing jump time
            this.jumpTimer++; 
            this.dy = -this.jumpForce - (this.jumpTimer / 50);
        }
    }

    // drawing the character bunny
    Draw(imageID){ 
            let img=document.getElementById(imageID);
            context.drawImage(img,this.xPos, this.yPos,this.width,this.height);
    }
}


// Class for the enemy steep obstacles steeps
class SteepObstacle {

  constructor (xPos, yPos, width, height, color) {
        this.xPos = xPos; // x position
        this.yPos = yPos; // y position
        this.width = width; // width
        this.height= height; //height
        this.color = color; //color
        this.dx = -gameSpeed; // x velocity 
    }
    
    // updating the obstacles in the game
  UpdateObstacle() {
        this.xPos += this.dx;
        this.Draw();

        //updating as we play
        this.dx = -gameSpeed; 
        //slowly gets faster
    }

  Draw () { 
      // drawing the obstacles 
        context.beginPath();
        context.fillStyle = this.color;
        context.fillRect(this.xPos, this.yPos, this.width, this.height);
        context.closePath();
    }
}


// Game Functions

// creating an obstacles
function CreateObstacle () { 

    // range for the size of the obstacles
    let size = RandomRanges(80, 135); 

    // type of obstacle either grounded or floated
    let type = RandomRanges(0, 1); 
    // creating an obtacle by calling the class
    let obstacle = new SteepObstacle(canvas.width + size, canvas.height - size, size, size, '#298f25');

    // if floating obtacles
    if (type == 1) { 
        obstacle.yPos -= player.originalHeight - 20;
    }
    
    // add obtacle to the obstacles array
    obstacles.push(obstacle); 
}


// function for randomizing the ranges
function RandomRanges (min, max) { 
    // returns a number which rounds to the random value
    return Math.round(Math.random() * (max - min) + min); // random values
}


// to initialize the game
function StartGame () { 

    // canvas width
    canvas.width = window.innerWidth; 
    //canvas height
    canvas.height = window.innerHeight;

    context.font = "50px sans-serif";
    
    // speed of the game
    gameSpeed = 3;

    // gravity of the jump of the bunny
    gravity = 0.7;

    // adding score as 0
    score = 0; 
    
    // calling the player and entering the parameters
    player = new BunnyPlayer(25, 50, 180, 177); 

    // drop or fall audio will be played
    var audio = new Audio('sound/fall.mp3');
    audio.play(); 

    // start animation when calling a function
    request=requestAnimationFrame(UpdateGame); 
}


// timer variables for each obstacle generation
let initialGenerateTimer = 200;
let generateTimer = initialGenerateTimer;


// Updating the game
function UpdateGame () { 

    request=requestAnimationFrame(UpdateGame); // keepp on looping
    
    // clear the canvas every frame
    context.clearRect(0, 0, canvas.width, canvas.height); 

    // decrementing the generation time during the game
    generateTimer--;

    // if the generation time is greater than 0
    if (generateTimer <= 0) { 

        // create obstables
        CreateObstacle(); 
        // show the position, size of the obstacles in the console
        console.log(obstacles); 

        // slowly the generation of obstacles get quicker over time the game
        generateTimer = initialGenerateTimer - gameSpeed * 8; 

        // if generation time is less than 65
        if (generateTimer < 65) {
            generateTimer = 65;
        }
    }


    // steep obstacles
    // looping the obtsacles
    for (let i = 0; i < obstacles.length; i++) { 

        // for each obstacle in the array
        let obs = obstacles[i];

         //the obstacle blocks goes out of the canvas gets deleted
        if (obs.xPos + obs.width < 0) {
            //by removing  existing elements from the array
            obstacles.splice(i, 1);
        }

         // if  the obstacles collides with the player
        if (
            player.xPos <= obs.xPos + obs.width &&
            player.xPos + player.width >= obs.xPos &&
            player.yPos <= obs.yPos + obs.height &&
            player.yPos + player.height >= obs.yPos
        )   {
                // cancel animation when the game is over
                cancelAnimationFrame(request);

                // calling the afterCollision function
                afterCollision();
                
            }
            obs.UpdateObstacle(); // updating the obstacles
    }
    player.AnimatePlayer(); // animating the player

    // creating a score text
    // the attributes
    context.font = "600 70px sans-serif";
    context.fontWeight = "Bold";
    context.fillStyle = "black";
    context.textAlign="right";
    // the text
    context.fillText('Score: '+score, canvas.width - 30, 75);


    // incrementing the  score throughout the game
    score++; 

    // increasing the game speed by 0.0025 
    gameSpeed += 0.0025; 
}


// function for after collions
function afterCollision(){

    // crash audio will be played
    var audio = new Audio('sound/gameEnd2.wav');
    // play the audio
    audio.play(); 
    
    // cancelling the animation after game is over
    // cancelAnimationFrame(request); 


    // text for when the game is over
    // the attributes
    context.font = "600 180px sans-serif";
    context.fontWeight = "Bold";
    context.fillStyle = "black";
    // the text
    context.fillText('Game Over', 1300, canvas.height / 2 - 30);
   
    // shows the game score in the game Stuff div
    document.getElementById("scoreText").innerHTML="Score: "+score; 
   
    
    // storing the highscore in the local storage of the logged in user
    if(sessionStorage.loggedInUsername !== undefined){

        let usr = JSON.parse(localStorage[sessionStorage.loggedInUsername]);
        // if the highscore is higher than the score stored in the local storage
        if(usr.maxScore < score){ 
            usr.maxScore = score;
            // store highscore in the local storage
            localStorage[usr.username] = JSON.stringify(usr);  
        }
    }
}


// Text for starting the game
// the attributes
context.font = "600 20px sans-serif";
context.fontWeight = "Bold";
context.fillStyle = "black";
context.textAlign = "center";

// the text
context.fillText("Press the Start Button to Play", 150, 70);