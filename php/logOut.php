<?php
  // Connect to the database
  include("databaseConnect.php");

  //Start the session
  session_start();
  $username = $_SESSION["username"];

  //Destroy the session
  session_destroy();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <title>uLike - Log Out</title>
  <!--jQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!--Icon-->
  <link rel="icon" href="../images/favicon.ico">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <!--Style CSS-->
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--Custom JS-->
  <script src="../js/iconBar.js"></script>
  <script src="../js/sidebarOpacity.js"></script>
  <script src="../js/videoClick.js"></script>
  <script src="../js/hideShow.js"></script>
</head>
<body id="body">
  <!--Hidden Side Nav-->
  <div id="mySidenav" class="sidenav">
    <div class="row">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    </div>
    <div class="row">
      <a href="../index.html">Home</a>
    </div>
    <!-- <div class="row">
      <a href="php/signIn.php">Sign in</a>
    </div>
    <div class="row">
      <a href="php/register.php">Register</a>
    </div> -->
    <!--Below rows are to be added in logged in page-->
    <!-- <div class="row">
      <a href="myProfile.php">My Profile</a>
    </div>
      <div class="row">
      <a href="addAlbum.php">Add Album</a>
    </div>
      <div class="row">
      <a href="logOut.php">Log out</a>
    </div> -->
  </div>
  <!--Navbar-->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1">
          <span style="font-size:30px;cursor:pointer" onclick="openNav()">
          <button type="submit" class="btn" id="iconBar">
            <!-- Use any element to open the sidenav -->
            <div onclick="myFunction(this)">
              <span style="font-size:30px;cursor:pointer" onclick="openNav()"></span>
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
            </div>
          </button>
          </span>
        </div>
        <div class="col-md-1">
          <div class="navbar-header">
            <a class="navbar-brand" href="main.php">uLike</a>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <!--THIS IS WHERE ALL CODE GOES-->
  <div id="mainLogOut">
      <!--* * * * * * * * * * * * * *EDITED BY ADRIAN * * * * * * * * * * *-->
      <div class="row">
        <div class="col-md-9">
        </div>
        <div class="col-md-2 container-relog-in alert alert-dismissable fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <br>

          <?php
            $error = $_GET['error'];
            if($error == ""){
              echo '<div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Log out successful!</strong> Thank you for visiting our website. Please visit us again.
                    </div> ';

            }else if($error == 1){
              echo '<div class="alert alert-warning alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error: </strong> You did not enter any username and password.
                    </div>';
            }else if($error == 2){
              echo '<div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error: </strong> You entered the wrong username and/or password.
                    </div>';
            }else if($error == 3){
              echo '<div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error: </strong> You left the username and/or password blank.
                    </div>';
            }

           ?>
          <form method="post">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username"/>
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"/>
            <br>
            <button type="Submit" class="btn btn-lg btn-block btn-login-again" name="signInAgain" formaction="authenticateLogOut.php">Sign In Again</button>
            <br>
          </form>
          <button onclick="soundOn()" class="btn btn-lg btn-block btn-login-again" name="Unmute" id="Unmute">Unmute Sound</button>
          <button onclick="soundOff()" class="btn btn-lg btn-block btn-login-again" name="Mute" id="Mute">Mute Sound</button>
          <br>
        </div>
        <div class="col-md-1">
        </div>
      </div>

      <div id="styled_video_container">
        <?php
          $error = $_GET['error'];
          if($error == ""){
            echo '<div class="row" id="bottomRow">
                  <div class="col-md-12">
                  <h1 class="small-logout">Versace on the Floor - Bruno Mars</h1>
                  </div>
                  </div>
                  </div>
                  <video id="spotifyLogOut" autoplay loop src="../images/brunomars.mp4">
                  </video>';

          }else if($error == 1){
            echo '<div class="row" id="bottomRow">
                  <div class="col-md-12">
                  <h1 class="small-logout">When we were young - Adele</h1>
                  </div>
                  </div>
                  </div>
                  <video id="spotifyLogOut" autoplay loop src="../images/adele.mp4" type="video/mp4">
                  </video>';
          }else if($error == 2){
            echo '<div class="row" id="bottomRow">
                  <div class="col-md-12">
                  <h1 class="small-logout">Payphone - Maroon 5</h1>
                  </div>
                  </div>
                  </div>
                  <video id="spotifyLogOut" autoplay loop src="../images/maroon5.mp4" type="video/mp4">
                  </video>';
          }else if($error == 3){
            echo '<div class="row" id="bottomRow">
                  <div class="col-md-12">
                  <h1 class="small-logout">Aint it fun - Paramore</h1>
                  </div>
                  </div>
                  </div>
                  <video id="spotifyLogOut" autoplay loop src="../images/paramore.mp4" type="video/mp4">
                  </video>';
          }

         ?>

      </div>


</body>
</html>
