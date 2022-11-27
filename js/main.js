// for the ham burger menu 
const hamburger = document.querySelector('.hamburger')
const navbarLinks=document.getElementsByClassName('nav-links')[0]

//event listener when user clicks toogle icon, the nav links  shows up in a list form
hamburger.addEventListener('click',function(){
    this.classList.toggle('is-active');
    navbarLinks.classList.toggle('is-active');
});


// THIS IS FOR THE LOGIN PAGE 
// Switching between login card and registration card
let btnLogin = document.getElementById("login");
let btnSignUp = document.getElementById("signup");

let signIn = document.querySelector(".card-front");
let signUp = document.querySelector(".card-back");

// when login button is clicked, login card should show up
function changeToLogin(){
    signIn.classList.remove("inActive");
    signUp.classList.remove("active");
    
    message.style.visibility="hidden";
}


// when sign up button is clicked, registration card should show up
function changeToReg (){
    signIn.classList.add("inActive");
    signUp.classList.add("active");
    
    message.style.visibility="hidden";
}



/*VALIDATION and FUNCTIONING OF LOGIN AND REGISTRATION FORM*/


var formMessage=[]; // creating an array for form messages
// both the error and success message
var message=document.getElementById('message'); 


// Submission of the login form
function submitLoginForm(){

    // inputs from login form
    var username=document.getElementById('usernameLogin');
    var password=document.getElementById('passwordLogin');
   
    if(username.value.trim() =='' || password.value.trim() ==''){ // if username or password or both are not inputted
        formMessage.push("No blank values allowed. Fill all Fields"); // message

        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop();
        return false;
    }
    
    //User does not have an account
    if(localStorage[username.value] === undefined){ 
         //Inform user that they do not have an account

        formMessage.push("Username not recognized. Do you have an account?"); //message
        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop();
        return; //Do nothing
    }
    else{//User has an account
       let usrObj = JSON.parse(localStorage[username.value]);//Convert to object
       
       // if password which the user enters matches with the password in the local storage
       if(password.value === usrObj.password){//Successful login
            //add a line saying the user  is logged in
            message.style.visibility="hidden";
            document.getElementById("loginCard").remove();
            document.getElementById("loginPara").innerHTML = usrObj.username + " is logged in";
            document.getElementById("loginPara").style.fontSize="100px";
            document.getElementById("loginPara").style.backgroundColor="black";
            sessionStorage.loggedInUsername = usrObj.username;
        }
       else{// if passowrd not correct

            formMessage.push("Password not correct. Please try again.");
            message.style.visibility="visible";
            message.innerText= formMessage;
            formMessage.pop();
            return false;
        }
    }
    return true;
}



// registration form
function submitRegForm(){

    //inputs from registration form
    var username=document.getElementById('usernameReg');
    var dob=document.getElementById('date');
    var genders=document.getElementById('genders');
    var email=document.getElementById('email');
    var password=document.getElementById('passwordReg');

    
    
    // if any of the inputs are not filled
    if(username.value.trim() =='' || dob.value.trim() ==''|| genders.value.trim() =='' || email.value.trim() =='' || password.value.trim() ==''  ){
        
        formMessage.push("No blank values allowed. Fill all Fields"); //message
        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop(); // using pop to not cauz multiplication of the formMessage message
        return false;
    }

    // if email input is not filled in a correct format
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!email.value.match(validRegex) & (email.value.trim() !='')) {
        
        formMessage.push("Not Valid email address!"); // message
        message.style.visibility="visible";
        message.innerText= formMessage;  
        formMessage.pop();
        return false;      
    } 

    // making sure password is between the correct range
    if(password.value.length <=6 && password.value.length>0){
        formMessage.push('Password must be longer than 6 characters');

        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop();
        return false;
    }

    // password less than 15 chars
    if(password.value.length >15){
        formMessage.push('Password must be less than 15 characters'); // messages

        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop();
        return false;
    }
    


    // storing the user details in the registration form as as object
    let user={
        username: username.value,
        dateOfBirth: dob.value,
        gender:genders.value,
        emailID:email.value,
        password:password.value,
        maxScore:0
    };  

    // if user already exists
    if (localStorage[user.username] !== undefined) {
        
        formMessage.push('Username already exists. Type a new one'); // messages
        
        message.style.visibility="visible";
        message.innerText= formMessage;
        formMessage.pop();
        return false;
    }

    // Successfully registered
    localStorage[user.username]=JSON.stringify(user);
    formMessage.push('Registration successful'); // messages

    message.style.visibility="visible";
    message.innerText= formMessage;
    formMessage.pop();

}