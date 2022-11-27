<?php
    //adding data from common.php into this file
    include('common.php');

    // calling the functions
    outputHeader('Game');
    outputNavbar('Game');
?>

<?php 
    // a variable which contains the file path for the game javascript file
    $src = 'js/game.js';
?>

<!--Adding extra elements for this page-->
<!--main content between navbar and footer-->
<section class="main-content">
    <h1>THE GAME</h1>
    <!--Message for logged in user-->
    <p id="userMessage"></p>
    
    <!--container for the game-->
    <div class="container" style="position:relative;">
        
        <!--Game will be inside the game div  -->
        <div class="game" id="gameDiv" style = "text-align:center; margin:auto;">
            
            <!--Canvas where the game will be played-->
            <canvas id="game"></canvas> 
        </div>

        <div id="game-stuff">
            <!--Message when the game is over and will show the score for few seconds-->
            <img src="images/bunny-animated.gif" style="width:90px; height:70px;"/>
            <div class="score-tell">
                <p id="scoreText" style="font-size: 45px;">Score: </p>
            </div>
            <!--Buttons for the game-->
            <div id="startButton" style="padding-top:8px;">
                <button type="button" id="StartGame" onclick="StartGame()" style="font-size: 32px; background-color:#804E49;">Start</button>
            </div>
            <p id="restart-message" style="font-size:22px;"></p>
        </div>
        <!--the image of the character bunny player-->
        <img id="bunnyPlayer" src="images/bunny.png" style="display:none;"/>
        
    </div>
</section>


<script>
    // removing the start button when the game starts
    // adding the restart button after clicking the start button
    document.getElementById('StartGame').addEventListener("click", () => {
	    
        document.getElementById("StartGame").remove();
        document.getElementById("startButton").innerHTML="<button type='button' id='RestartGame' onclick='RestartGame()' style='font-size: 32px; background-color:#804E49;'>Restart</button>";
        document.getElementById("restart-message").innerHTML="<p>To restart the game</br>click the button</p>";
    });

    function RestartGame(){ // restarting the game by reloading the page
        location.reload();
    }
    
       
    window.onload = checkLogin; //When the window loads, Checks to see if user is logged in already
    
    function checkLogin(){
        if(sessionStorage.loggedInUsername !== undefined){
            //Extract details of logged in user
            let usrObj = JSON.parse(localStorage[sessionStorage.loggedInUsername]);
            
            //add a line saying the user  lis logged in
            document.getElementById("userMessage").innerHTML= usrObj.username+" play the game";
            document.getElementById("userMessage").style.fontSize="40px";
        }
    }
    let cookies = document.cookie;

    window.addEventListener("keydown", function(e) { // prevents the moving of page using the keys while playing the game
        if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
            e.preventDefault();
        }
    }, false);

</script>

<!--The game javascript file is called-->
<script src= '<?php echo $src;?>'></script> 

<?php
    //calling the function
    outputFooter();
?>