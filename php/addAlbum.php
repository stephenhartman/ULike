<?php
    // Connect to the database
    include("databaseConnect.php");

    //Start the session
session_start();
$username = $_SESSION["username"];
if ($username == ""){
  header("Location: signIn.php?error=3");
  die();
}

    //Get the userID
    //Query
    $getUser = "SELECT userID, username FROM Users";
    $result1 = mysqli_query($databaseConnect, $getUser);

    //Parse Through DB
    while ($row = mysqli_fetch_array($result1)) {
        $userIDDB = $row[0];
        $usernameDB = $row[1];

        if($usernameDB == $username){
          $userID = $userIDDB;
        }

      }

    //If button is clicked
    if(isset($_POST['submitData'])){

      //Image Upload
      $image_name = addslashes($_FILES['albumPhoto']['name']);
      $image = addslashes(@file_get_contents($_FILES['albumPhoto']['tmp_name'])); //SQL Injection defence!

      //Variables
      $albumName = $_POST['albumName'];
      $albumArtist = $_POST['albumArtist'];
      $albumYear = $_POST['albumYear'];
      $albumGenre = $_POST['albumGenre'];
      $spotifyLink = $_POST['spotifyLink'];

      $required = array('albumName', 'albumArtist', 'albumYear', 'albumGenre', 'spotifyLink');

      $error = false;
          foreach($required as $field) {
          if (empty($_POST[$field])) {
            $error = true;
          }
        }

        // if(!$image){
        //   $nopic = '<div class="alert alert-warning">
        //                   <strong>Empty field/s were detected</strong> Please check the empty fields and please re-upload the picture. Thanks!
        //                 </div>';
        //
        // }
        error_reporting(0);
        if($error || ($image == FALSE)){
          $empty = '<div class="alert alert-warning alert-dismissable fade in">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Empty field/s and/or album picture were missing</strong> Please fill out the form again. Thanks!
                        </div>';
          }
                if(!$error){
                  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                  $sqlinsert = "INSERT INTO Albums (userID, albumName, albumArtist, albumYear, albumGenre, spotifyLink, albumPhotoName, albumPhoto) VALUES ('$userID','$albumName', '$albumArtist', '$albumYear', '$albumGenre', '$spotifyLink', '{$image_name}','{$image}')";
                  $_POST = array();
                    if(!mysqli_query($databaseConnect, $sqlinsert)){
                      die('Error inserting new record. Please click here <a href="addAlbum.php">Add Album </a>');
                    }

                  $newrecord = '<div class="alert alert-success alert-dismissable fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  <strong>Data submitted!</strong> You can view the album that you uploaded <a href="home.php">here.</a>
                                </div>';
                  }

      }
      // move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
      // $sqlinsert = "INSERT INTO Albums (userID, albumName, albumArtist, albumYear, albumGenre, spotifyLink, albumPhotoName, albumPhoto) VALUES ('$userID','$albumName', '$albumArtist', '$albumYear', '$albumGenre', '$spotifyLink', '{$image_name}','{$image}')";
      // $result = mysqli_query($databaseConnect, $sqlinsert);



      /* * * * * * * * * * * * DEBUGGERS* * * * * * * * */
      // echo $albumName ."<br>";
      // echo $albumArtist ."<br>";
      // echo $albumYear ."<br>";
      // echo $albumGenre ."<br>";
      // echo $spotifyLink ."<br>";



 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <title>uLike - Add Album</title>
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
  <script src="../js/imgup.js"></script>
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
    <!-- <div class="row">
      <a href="php/signIn.php">Sign in</a>
    </div>
    <div class="row">
      <a href="php/register.php">Register</a>
    </div> -->
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
      <!--* * * * * * * * * * * *EDITED BY ADRIAN* * * * * * * * * * * * * * * * *-->
      <div class="row">
        <?php echo $nopic;
        echo $empty;
        echo $newrecord;
         ?>
        <div class="col-md-6">
          <form method="post" enctype="multipart/form-data">
          <input type="hidden" name="submitted" value = "true"/>
          <!--UPLOAD PICTURE-->
          <h3> Step 1: Upload the picture</h3>
          <div class="form-group">
            <label>Upload Image</label>
            <div class="input-group">
              <span class="input-group-btn">
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" id="imgInp" name="albumPhoto"/>
                    </span>
              </span>
              <input type="text" class="form-control" readonly/>
            </div>
            <img type="hidden" id="img-upload" width="100%" height="auto"/>
            <!--END UPLOAD PICTURE-->
            <h3> Step 2: Give Album Details </h3>
            <label for="albumName">Album Name:</label>
            <input type="text" class="form-control" id="albumName" name="albumName"/>

            <label for="artistName">Artist Name:</label>
            <input type="text" class="form-control" id="albumArtist" name="albumArtist"/>

            <label class="control-label" for="albumYear">Album Year:</label>
            <select class="form-control" name="albumYear" id="albumYear">
            </select>

            <label for="genre">Album Genre:</label>
            <select class="form-control" id="albumGenre" name="albumGenre">
                <option value="">Select Genre:</option>
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Country">Country</option>
                <option value="R&B">R&B</option>
                <option value="HipHop">HipHop</option>
                <option value="Metal">Metal</option>
              </select>


            <label for="spotifyLink">Spotify Link:</label>
            <input type="text" class="form-control" id="spotifyLink" name="spotifyLink"/>
            <!-- <label for="uploadedBy">Uploaded by:</label> -->
            <input type="hidden" class="form-control" id="uploadedBy" name="uploadedBy" value="<?php echo $username ?>" placeholder="<?php echo $username ?>"/>
        </div>
      </div>
        <div class="col-md-6">
          <div id="uploadResult">
            <br>
            <img id="img-upload-reflect" width="50%" height="50%"/>
            <br>
            <h4>Album Name: <b><small class="small-reflect" id="albumNameReflect"></small></b></h4>
            <h4>Artist: <b><small class="small-reflect" id="artistReflect"></small></b></h4>
            <h4>Album Year: <b><small class="small-reflect" id="dateReflect"></small></b></h4>
            <h4>Album Genre: <b><small class="small-reflect" id="genreReflect"></small></b></h4>
            <h4>Spotify Link: <b><small class="small-reflect" id="spotifyLinkReflect"></small></b></h4>
            <h4>Uploaded by: <b><small class="small-reflect"><?php echo $username ?></small></b></h4>
            <br>
          </div>
          <h3> Step 3: Press Submit</h3>
          <button type="submit" class="btn btn-add-album btn-large btn-block" formaction="addAlbum.php" name="submitData">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/reflection.js"></script>
  <script>
    var min = 1900,
        max = 2017,
        select = document.getElementById('albumYear');

    for (var i = min; i<=max; i++){
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }

    select.value = new Date().getFullYear();
  </script>

  <!-- <script src="../js/getYear.js"></script> -->
</body>
</html>
