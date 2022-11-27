<?php
    include('common.php');

    //calling the function
    outputHeader('How To Play');
    outputNavbar('How To Play');
?>


<!--Adding extra elements for this page-->
<!--main content between navbar and footer-->
<section class="main-content">
    <h1>Tutorial for the Game</h1>
    <br>
    <!--Text box for the tutorial-->
    <div class="text-box">
        <p style="padding:30px; font-size:30px;"> To be able to store your high scores in your leaderboard, the user should create an account. Login and Play</p>
        <!--Each tutorial in list-->
        <ul class="how_to_play" style="font-family:Times New Roman, Times, serif;">
            <li>This is an endless game where the player will be controlling the bunny.</li>
            <li>The user controls make the bunny hop by pressing the up arrow or Space Key.</li>
            <li>To make the bunny duck by pressing the down arrow or Shift Left key.</li>
            <li>Bunny must deflect the obstacles, that is, the steeps, by hopping or ducking according to how the steeps are placed.</li>
            <li>Depending on how the obstacles are placed, the user will accordingly have to control the bunny’s movements to be able to avoid them.</li>
            <li>As the game progresses, the speed increases, making the game more challenging.</li>
            <li>If the bunny dashes against the obstacle, it dies. The game is over.</li>
            <li>The bunny has only one life.</li>
        </ul>
    </div>

</section>




<?php
  //calling the function
  outputFooter();
?>