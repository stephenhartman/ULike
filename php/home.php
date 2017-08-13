<?php
include("databaseConnect.php");
session_start();
$username = $_SESSION["username"];
if ($username == ""){
  header("Location: signIn.php?error=3");
  die();
}
?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset=utf-8>
   <title>uLike - Home</title>
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
   <script src="../js/showAlbum.js"></script>
   <script src="../js/rateYo.js"></script>
   <!-- RateYo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 </head>
 <body id="body">
   <!--Hidden Side Nav-->
   <div id="mySidenav" class="sidenav">
     <div class="row">
     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
     </div>
     <div class="row">
       <a href="home.php">Home</a>
     </div>
     <!--Below rows are to be added in logged in page-->
     <div class="row">
       <a href="myProfile.php">My Profile</a>
     </div>
       <div class="row">
       <a href="addAlbum.php">Add Album</a>
     </div>
       <div class="row">
       <a href="logOut.php">Log out</a>
     </div>
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
             <a class="navbar-brand" href="home.php">uLike</a>
           </div>
         </div>
       </div>
     </div>
   </nav>


   <!--THIS IS WHERE ALL CODE GOES-->
   <div id="main">
     <div class="container">
       <!-- EDITABLE CODE -->
       <div id='albumDetails'>
         <?php
         $success = $_GET['success'];
         if($success == "1"){
           echo '<div class="alert alert-success alert-dismissable fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>Review added! </strong> Thank you for your review.
                 </div>';

         }

         $error = $_GET['error'];
         if($error == "1"){
           echo '<div class="alert alert-warning alert-dismissable fade in">
                 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                 <strong>Error: </strong> You forgot to put in your review. Please click the album and review again.
                 </div>';

         }
         ?>
       <h1>Albums</h1>
             <?php
               //Query
               $query = "SELECT * FROM Albums ORDER BY albumID DESC";
               $result = mysqli_query($databaseConnect, $query);

               //Parse the whole DB
               while($row = mysqli_fetch_array($result)){
                 echo '<img class="albumPhoto" id="'.$row["albumID"].'"height="200px" width="200px" onclick ="showAlbum(this.id)" src="data:image/jpeg;base64,'.base64_encode($row['albumPhoto'] ).'"/>';
				          echo "&nbsp &nbsp";
               }
              ?>
            </div>
     </div>
   </div>
 </body>
 </html>
