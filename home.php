<?php
    //adding data from common.php into this file
    include('common.php');

    // calling the functions
    outputHeader('Home');
    outputNavbar('Home');
?>

<?php 
    // creating variables for the php files
    $login="login.php";
    $game="game.php";
    // variable for logout function
    $logout="logout()";
?>


<!--Adding extra elements for this page-->
<!--main content between navbar and footer-->
<section class="main-content">
    <h1>WELCOME TO BUNNY HOP</h1>
    <p>The Game with No End</p>
    <br>
      
    <!--Message welcoming the logged in user-->
    <p id="welcomeUser" style="padding: 20px;"></p>

    <div class="simple-text">
          <p>Play the world's most Incredible game</p>
          <p>And that too for FREE!!</p>
    </div>
    
    
    <!--Buttons for the guest user-->
    <div class="userButtons" id="buttons">
        <a href='<?php echo $game;?>' class="button">Continue as Guest</a>

        <div class="login">
            <p>Already a Member, Sign in</p>
            <a href='<?php echo $login;?>' class="button">Log In</a>
        </div>
    </div>

    <!--If the logged in user wishes to  sign out-->
    <p id="logoutMessage" style="padding-top:40px; font-size: 30px;"></p>
    <div id="logoutButton"></div>

</section>



<!--javascript link-->
<script>

    window.onload = checkLogin;//Check to see if user is logged in already
    function checkLogin(){
        if(sessionStorage.loggedInUsername !== undefined){
            //Extract details of logged in user
            let usrObj = JSON.parse(localStorage[sessionStorage.loggedInUsername]);
            
            //add a line saying the user  lis logged in
            document.getElementById("welcomeUser").innerHTML="Hello "+usrObj.username;
            document.getElementById("welcomeUser").style.fontSize="40px";

            // removing the guest user buttons
            document.getElementById("buttons").remove();

            // adding the signed in user elements
            document.getElementById("logoutMessage").innerText="Do you wish to signout?";
            document.getElementById("logoutButton").innerHTML="<button onclick='<?php echo $logout;?>'>Log Out</button>";
        }
    }
    let cookies = document.cookie;

    
    //Logs user out
    function logout(){
        sessionStorage.removeItem("loggedInUsername");
        location.reload(); // reloads the page
    }
</script>

<?php
    //calling the function
    outputFooter();
?>