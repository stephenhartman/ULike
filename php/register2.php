<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <title>uLike</title>
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
            <a class="navbar-brand" href="signIn.php">uLike</a>
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

include('databaseConnect.php');

if(isset($_POST["submitData"])){

	foreach( $_POST as $key => $value)
	{
		${$key} = $value;
	}

  //Image Upload
  $image_name = addslashes($_FILES['profilePicture']['name']);
  $image = addslashes(@file_get_contents($_FILES['profilePicture']['tmp_name'])); //SQL Injection defence!


	$error = false;


	/* Checks to make sure first name, last name, and location only has alphabet characters */
	function hasOnlyLetters($str) {
		return preg_match('/^[a-zA-Z\s]+$/', $str);
	}

	if(!hasOnlyLetters($firstName)){
		$error = true;
		$message = '<div class="alert alert-warning alert-dismissable fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>First name contains illegal characters.</strong> Please try again.</div>';

	}
	else if(!hasOnlyLetters($lastName)){
		$error = true;
		$message = '<div class="alert alert-warning alert-dismissable fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Last name contains illegal characters.</strong> Please try again.</div>';

	}
	else if(!hasOnlyLetters($locationState)){
		$error = true;
		$message = '<div class="alert alert-warning alert-dismissable fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Location contains illegal characters.</strong> Please try again.</div>';

	}
	else {
	}


    $query = "SELECT username FROM Users";
    $result = mysqli_query($databaseConnect, $query);

    /* Makes sure user name does not already exists */
    while ($record = mysqli_fetch_array($result)) {
        $user = $record[0];

        if($user == $username)
        {
			$error = true;
		    $message = '<div class="alert alert-warning alert-dismissable fade in" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>User name is already taken.</strong> Please enter a different user name and try again.</div>';

		}
    }


	/* Check for blank fields exept profile picture*/
	if(empty($username) || empty($password) || empty($firstName) || empty($lastName) || empty($locationState) || empty($email) ) {
		$error = true;
		$message = '<div class="alert alert-warning alert-dismissable fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>All fields are required.</strong> Please enter an input for all fields and try again.</div>';
	}

	if ($error == true & isset($message) ) {
		echo $message. "<br>";
	} else {
		$stmt = $databaseConnect->prepare("INSERT INTO Users (profilePictureName, profilePicture, username, password, firstName, lastName, locationState, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt-> bind_param("sbssssss", $image_name, $image, $username, $password, $firstName, $lastName, $locationState, $email);

		$stmt->execute();
		$stmt->close();

    $successRedirect = '<div class="alert alert-success alert-dismissable fade in" align="center">
           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>Congratulations on your new account! You will be redirected in 2 seconds.
           </div>';

		echo '<META HTTP-EQUIV="refresh" content="2; url=http://139.62.210.151/~group3/cop4813/php/signIn.php?success=1">';
	}
}?>

      <?php echo $successRedirect; ?>
	<br>
		<div class="row">
			<div class="col-md-6">

        <!--UPLOAD PICTURE-->
        <div class="form-group">
          <label>Profile Picture</label>
          <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <img id="img-upload-register" width="100%" height="auto"/>
            </div>
            <div class="col-md-4">
            </div>
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-btn">
                  <span class="btn btn-default btn-file">
                      Upload<input type="file" id="imgInp" name="profilePicture"/>
                  </span>
            </span>
            <input type="text" class="form-control" readonly/>
          </div>
        </div>
          <!--END UPLOAD PICTURE-->


				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" value="<?=(isset($username) ? $username : "")?>" />
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>" />

				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="firstName" name="firstName" value="<?php if(isset($_POST['firstName'])){echo $_POST['firstName'];} ''; ?>" />

				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lastName" name="lastName" value="<?php if(isset($_POST['lastName'])){echo $_POST['lastName'];} ?>" />

				<label for="locationState">State</label>
				<input type="text" class="form-control" id="locationState" name="locationState" value="<?php if(isset($_POST['locationState'])){echo $_POST['locationState'];} ?>" />

				<label for="email">E-mail Address</label>
				<input type="text" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" />
				<br/>
				<button type="submit" class="btn btn-add-album btn-large btn-block" formaction="register.php" name="submitData">Submit</button>
				</form>
			</div>
			<div class="col-md-6">
				<div class="media">
					<br/>
					<img class="img-rounded center-block" src="../images/IconGreenBG.png" alt="Logo">
					<h4 class="mt-0">Welcome to ULike!</h4>
					<p>Welcome to the place where you pick what music you like and tell the world about it.</p>
					<p class="mb-0">Here you are welcome to upload any album you like into our database and write a review for the world to see.  You can also review any album that anyone else has uploaded before, which will introduce you to what others like while providing content which will suprise your music tastes.</p>
				</div>
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
