<?php
    //adding data from common.php into this file
    include('common.php');

    //calling the function
    outputHeader('Login');
    outputNavbar('');
?>


<!--Adding extra elements for this page-->
<!--main content between navbar and footer-->
<section class="main-content">
    <div class="container-card">
        <div class="card">
            <div class="inner-box">
                <!--messages that will display that the username is logged in-->
                <p id="loginPara"></p>

                <!--LOGIN CARD-->
                <!--where user enter it's username and password to log in-->
                <div class="card-front" id="loginCard">
                    <h1>LOGIN</h1>
                    
                    <!--A form for login-->
                    <form onsubmit="return submitLoginForm()">
                        <!-- Fields -->
                        <input type="text" id="usernameLogin" class="input-box" placeholder="Your Username">
                        <input type="password" id="passwordLogin" class="input-box" placeholder="Password">
                        <button class="submit-btn" type="submit">Submit</button>
                    </form>

                    <!-- Button for changing to reg form -->
                    <a class="btn" id="signup" onclick="changeToReg()">I'm new Here</a>
                </div>


                <!--Register CARD-->
                <!--Where user will have to enter it's details to create an account-->
                <div class="card-back">
                    <h1>REGISTER</h1>

                    <!--A form for registration-->
                    <form id="regForm" onsubmit="return submitRegForm()">
                        <!--Input -->
                        <input type="text" id="usernameReg" class="input-box" placeholder="Your Username">
                        <input placeholder="Date of Birth" id="date" class="input-box" type="text" onfocus="(this.type='date')" max="2005-12-31" min="1970-01-01">
                        
                        <div class="select">
                            <label for="genders">Select your gender: </label>
                            <select name="genders" id="genders">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <input type="text" id="email" class="input-box" placeholder="Your Email ID">
                        <input type="password" id="passwordReg" class="input-box" placeholder="Password">
                                                
                        <button class="submit-btn" type="submit">Submit</button>
                    </form>
                                        
                    <a class="btn" id="login" onclick="changeToLogin()">I have an account</a>

                </div>

                <!--Message that will display the error or whether form is successful-->
                <div id="message" style="visibility: hidden; position: relative; padding: 10px;"></div>
            </div>
        </div>
    </div>
</section>

<script>
    
    // for the login page
    window.onload = checkLogin;//Check to see if user is logged in already

    function checkLogin(){
        if(sessionStorage.loggedInUsername !== undefined){
            //Extract details of logged in user
            let usrObj = JSON.parse(localStorage[sessionStorage.loggedInUsername]);
            
            // creating changes to the form which says user is logged in
            document.getElementById("loginCard").remove();
            document.getElementById("loginPara").innerHTML = usrObj.username + " is logged in";
            document.getElementById("loginPara").style.fontSize="100px";
            document.getElementById("loginPara").style.backgroundColor="black";
            
        }
    }

    let cookies = document.cookie;  
</script>


<?php
    //calling the function
    outputFooter();
?>