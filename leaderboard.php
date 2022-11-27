<?php
    //adding data from common.php into this file
    include('common.php');

    // calling the functions
    outputHeader('Leader Board');
    outputNavbar('Leader Board');
?>


<!--Adding extra elements for this page-->
<!--main content between navbar and footer-->
<section class="main-content">
    <h1>Leader Board!!</h1>
    <p id="greeting">Check the scoring below</p>
    <br>

    <!--cdiv for the leaderboard table-->
    <div id="table-ranking" class="col-md-12 col-lg-6 example"></div>

</section>

<script>
  //Loads leaderboard table into page
 
        // Creating a table 
        let tableStr = "<table id='leaderboard'><tr><th>Name</th><th>Score</th></tr>";
        for(let key of Object.keys(localStorage)){ // all the keys in the local storage
            let usr = JSON.parse(localStorage[key]);
            tableStr += "<tr></td><td>" + usr.username + "</td><td>" + usr.maxScore + "</td></tr>";
        }
        tableStr += "</table>";
        document.getElementById("table-ranking").innerHTML = tableStr;
    

  //Checks login and loads ranking table when page loads
  window.onload = ()=> {  
        // calling the functions
        sortTable();

        //Check login
        if(sessionStorage.loggedInUsername !== undefined){
            let usrObj = JSON.parse(localStorage[sessionStorage.loggedInUsername]);
            // if user is logged in, puts out the greeting line
            document.getElementById("greeting").innerHTML = usrObj.username+", Check the scoring below";
        }
            
    }


    // JavaScript Program to illustrate
    // Table sort on a button click
    function sortTable() { // sorting the table by the users highscore in descending order
        var table, i, x, y;
        table = document.getElementById("leaderboard");
        var switching = true;
  
        // Run loop until no switching is needed
        while (switching) { // for switching the rows in the table
            switching = false;
            var tableRows = table.rows;
  
            // Loop to go through all rows in the table
            for (i = 1; i < (tableRows.length - 1); i++) {
                var Switch = false;
  
                // Fetch 2 elements of the high score that need to be compared
                x = tableRows[i].getElementsByTagName("TD")[1];
                y = tableRows[i + 1].getElementsByTagName("TD")[1];
  
                // Check if 2 highscores need to be switched
                if (parseInt(x.innerHTML.toLowerCase()) < parseInt(y.innerHTML.toLowerCase()))
                {
                    // If yes, mark Switch as needed and break loop
                    Switch = true;
                    break;
                }
            }
            if (Switch) {
                // Function to switch tableRows and mark switch as completed
                tableRows[i].parentNode.insertBefore(tableRows[i + 1], tableRows[i]);
                switching = true;
            }
        }
    }
</script>

<?php
  //calling the function
  outputFooter();
?>