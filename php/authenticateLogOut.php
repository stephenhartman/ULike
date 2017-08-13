<?php
    //Connect to the Database
    include("databaseConnect.php");
    //Starts the Session
    session_start();

    //If button is clicked
    // if(isset($_POST['signInAgain'])){


      //Get the username and password
      $logOutUsername =$_POST['username'];
      $logOutPassword =$_POST['password'];
      $_SESSION['username'] = $logOutUsername;

      //SQL Injection
      // $logOutUsername = stripcslashes($logOutUsername);
      // $logOutPassword = stripcslashes($logOutPassword);
      // $logOutUsername = mysqli_escape_string($databaseConnect, $logOutUsername);
      // $logOutPassword = mysqli_escape_string($databaseConnect, $logOutPassword);
      // $logOutPassword = md5($logOutPassword);


      //Query
      $query = "SELECT username, password FROM Users";
      $result = mysqli_query($databaseConnect, $query);


      //Parse Through DB
      while ($row = mysqli_fetch_array($result)) {
          $username = $row[0];
          $password = $row[1];
          // else if($logOutUsername == "" && $logOutPassword  ==""){
          //   //If empty
          //   echo '<a href="logOut.php?error=1"> Empty Fields</a>';
          //   // header("Location: logOut.php?error=1");
          // }

              if($username == $logOutUsername){
                if($password == $logOutPassword){
                    //Session Username
                    // echo '<a href="home.php"> Home </a>';
                    header("Location: home.php");
                    exit;
                  }
                  else{
                    //If Incorrect
                    // echo '<a href="logOut.php?error=2"> Wrong Username and Password Combination</a>';
                    header("Location: logOut.php?error=2");
                    exit;
                  }
                }else if($logOutUsername == "" && $logOutPassword  ==""){
                    // echo '<a href="logOut.php?error=1"> Empty Fields</a>';
                    header("Location: logOut.php?error=1");
                }else if($logOutUsername == "" || $logOutPassword==""){
                    header("Location: logOut.php?error=3");
                }else{
			header("Location: logOut.php?error=2");
		}
      }//end button
      mysqli_close($databaseConnect);

  // }


 ?>
