<!DOCTYPE html>
<html>
  <head>
   <meta charset=utf-8 />
   <title>uLike - Sign in</title>
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
   <!--w3 CSS Icons-->
   <!-- Add icon library -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!--Custom JS-->
   <script src="../js/iconBar.js"></script>
   <script src="../js/sidebarOpacity.js"></script>
    <script src="../js/hideShow.js"></script>
 </head>
 <body id="body">
   <!--Hidden Side Nav-->
   <div id="mySidenav" class="sidenav">
     <div class="row">
     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
     </div>
     <div class="row">
       <a href="main.php">Home</a>
     </div>
     <div class="row">
       <a href="signIn.php">Sign in</a>
     </div>
     <div class="row">
       <a href="register.php">Register</a>
     </div>
     <!--Below rows are to be added in logged in page-->
     <!--
     <div class="row">
       <a href="#">My Profile</a>
     </div>
       <div class="row">
       <a href="#">Add Album</a>
     </div>
       <div class="row">
       <a href="#">Log out</a>
     </div>
   -->
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
	<div class="muteWrapper">
	  <button type="button" onclick="soundOn()" class="btn btn-lg btn-block btn-warning" name="Unmute" id="Unmute">Unmute Sound</button>
	  <button type="button" onclick="soundOff()" class="btn btn-lg btn-block btn-warning" name="Mute" id="Mute">Mute Sound</button>
	</div>
       </div>
     </div>
   </nav>


   <!--THIS IS WHERE ALL CODE GOES-->
   <div id="main">
     <div class="container">
       <?php
         $error = $_GET['error'];
         $success = $_GET['success'];
            if($error == 1){
       echo '<div class="alert alert-warning alert-dismissable fade in" align="center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Invalid user name.</strong> Please check the user name field and try again. Thanks!
              </div>';
     }
     else if ($error == 2){
              echo '<div class="alert alert-warning alert-dismissable fade in" align="center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Invalid password.</strong> Please check the password field and try again. Thanks!
              </div>';
     }
     else if ($error ==3) {
              echo '<div class="alert alert-warning alert-dismissable fade in" align="center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>User name does not exist.</strong> Please check the user name field and try again. Thanks!
              </div>';
     }
     else if ($success == 1) {
       echo '<div class="alert alert-success alert-dismissable fade in" align="center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Congratulations on your new account! Please sign in!
              </div>';
     }
     else{
     }
        ?>

		<div class="row">
			<div class="col-md-6">
				<form method="post" action ="authenticate.php">
					 <label for="username">Username:</label>
					 <input type="text" class="form-control" id="username" name="username"/>
					 <label for="password">Password:</label>
					 <input type="password" class="form-control" id="password" name="password"/>
					 <br/>
					 <input type="Submit" class="btn-primary btn-lg btn-block" name="login" value="Sign in"/>
					 <a href="register.php" class ="btn btn-success btn-lg btn-block" role="button">Register</a>
			   </form>
			</div>
		<div class="col-md-6">
			<div class="media">
			<br/>
			<img class="img-rounded center-block" src="../images/IconGreenBG.png" alt="Logo">
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<h4 class="mt-0">Welcome to ULike!</h4>
				<p>Welcome to the place where you pick what music you like and tell the world about it.</p>
				<p class="mb-0">Here you are welcome to upload any album you like into our database and write a review for the world to see.  You can also review any album that anyone else has uploaded before, which will introduce you to what others like while providing content which may surprise your music tastes and help you discover your new favorite album.</p>
			</div>
		</div>
     </div>
   </div>
<audio preload="auto" loop>
<source src="../images/places.ogg" type="audio/ogg"/>
</audio>
<script src="../js/music.js"></script>

 </body>
</html>
