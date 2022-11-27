<?php

// the function header for all the pages
//includes the css links, page title and meta deta
function outputHeader($pageTitle){
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8" />';
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
    echo ' <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />';
    // page title variable
    echo '<title>'.$pageTitle.'</title>';
    echo '<link rel="stylesheet" href="css/style.css">';
   

    /*css for login page only */
    if($pageTitle=="Login"){
        echo '<link rel="stylesheet" href="css/form.css">';
    }

    /*css for game page only */
    if($pageTitle=="Game"){
        echo '<link rel="stylesheet" href="css/game.css">';
    }
    
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">';
    echo '<link rel="icon" type="image/png" href="images/logo.png">';
    echo '</head>';
    echo '<body>';
}


// the function nav-bar for all the pages
function outputNavbar($pageName){

    $linksTitle=array("Home","Game","How To Play","Leader Board");
    $linksAddress=array("home.php","game.php","tutorial.php","leaderboard.php");

    echo '<div class="banner">';
    echo '<header>';
    echo '<div class="container">';
    echo '<div class="logo">';
    echo '<a href="'.$linksAddress[0].'">';
    echo '<h3>BUNNY HOP!</h3>';
    echo '</a>';
    echo '</div>';

    echo '<nav class="nav-bar">';
    echo '<div class="nav-links">';
    echo '<ul>';

    // using array to make a list of all the links title and it's addresses
    
    // a for loop to echo all the list items
    for($x=0; $x < count($linksTitle); $x++){
        echo '<li>';
        echo '<a ';
        echo 'href="' .$linksAddress[$x].'"'; 
        if($linksTitle[$x]==$pageName){
            echo 'class="is-active"';
        }
        echo '">' .$linksTitle[$x]. '</a>';
        echo '</li>';
    }
    echo '</div>';

    echo '<input type="checkbox" id="check">';
    echo '<label for="check" class="checkbtn">';
    echo '<button  class="hamburger">';

    // a for loop to echo span tag 3 times
    for($y=0; $y<3;$y++){
        echo '<span></span>';
    }
    
    echo '</button>';
    echo '</label>';
    echo '</nav>';
    echo '</div>';
    echo '</header>';
}


// the function for the footer for all pages
function outputFooter(){

    echo'</div>';
    echo '<!--Footer which contains social media and copyright info-->';
    echo '<footer class="footer-main">';
    echo '<div class="footer-left">';
    echo '<h3>Bunny Hop</h3>';
    echo '<p class="footer-description">An Interactive and Fun Game. Fun Unlimited.</p>';
    echo '<p class="copyright">Copyright &copy; 2021</p>';
    echo '</div>';
    echo '<div class="footer-center">';
    echo '<div>';
    echo '<p><span></span>Contact Us</p>';
    echo '<br>';
    echo '</div>';
    echo '<div>';
    echo '<i class="bi bi-telephone"></i>';
    echo '<p>+1 234 56789</p>';
    echo '</div>';
    echo '<div>';
    echo '<i class="bi bi-envelope"></i>';
    echo '<p><a href="mailto:support@company.com">bunnyhop@email.com</a></p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="footer-right">'; 
    echo '<p class="creator">';
    echo '<span>Created by</span>';
    echo 'Adora Naomi Fernandes';
    echo '</p>';
    echo '<div class="footer-icons">';

    // array for social medias
    $socialMedias=array("facebook","twitter","instagram");
    for($z=0;$z<count($socialMedias);$z++){ // looping it
    echo '<a href="#"><i class="bi bi-'.$socialMedias[$z].'"></i></a>';
    }

    echo '</div>';
    echo '</div>';
    echo '</footer>';
    echo '<script src="js/main.js"></script>';
    echo '</body>';
    echo '</html>';
}

