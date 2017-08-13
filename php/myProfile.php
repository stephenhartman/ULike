<?php
//Connect to the DB firstNameDB
include("databaseConnect.php");
session_start();

$username = $_SESSION["username"];
if ($username == ""){
  header("Location: signIn.php?error=3");
  die();
}


//Get the userID
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

//Query
$getData = "SELECT * FROM Users WHERE userID =".$userID;
$result = mysqli_query($databaseConnect, $getData);
//Parse Through DB
while ($row = mysqli_fetch_array($result)) {
	$username = $row[1];
	$firstName = $row[3];
	$lastName = $row[4];
	$locationState = $row[5];
	$email = $row[6];
	$profilePictureName = $row[7];
	$profilePicture = $row[8];

  }
$getReviews = "SELECT albumID, rating, description, createdOn FROM Reviews WHERE userID=".$userID." ORDER BY createdOn DESC";
$result2 = mysqli_query($databaseConnect, $getReviews);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <title>uLike - My Profile</title>
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
            <a class="navbar-brand" href="home.php">uLike
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <!--THIS IS WHERE ALL CODE GOES-->
  <div id="main">
    <div class="container">
	<form action="" method="post" enctype="multipart/form-data" name="userData">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<h3> My Profile</h3>
					<div class="col-md-12">
						<label for="username">Username</label>
						<input readonly type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="firstName">First Name</label>
						<input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
					</div>
					<div class="col-md-6">
						<label for="lastName">Last Name</label>
						<input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="locationState">Location</label>
						<input type="text" class="form-control" id="locationState" name="locationState" value="<?php echo $locationState; ?>">
					</div>
					<div class="col-md-8">
						<label for="email">Email Address</label>
						<input readonly type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
					</div>
				</div>
				<div class ="row"><div class="col-md-6"><br/></div></div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" class="btn btn-add-album btn-large btn-block" formaction="modifyUser.php" name="submitData">Modify</button>
					</div>
					</div>
				<div class="row">
					<br/>
					<div class="col-md-12">
						<?php
						  $error = $_GET['error'];
						  if($error == "2"){
							echo '<div class="alert alert-success alert-dismissable fade in">
								  <strong>User credentials successfully changed.</strong>
								  </div> ';
						  }else if($error == 1){
							echo '<div class="alert alert-warning alert-dismissable fade in">
								  <strong>Error: </strong> Invalid entry.
								  </div>';
						  }
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 col-md-offset-1"><br/>
				<h4>Profile Picture</h4>
					<!--Profile Picture-->
							<?php
							if ($profilePictureName == null){
								echo '<img class="albumPhoto" id="profile" height="200px" width="200px" src="../images/placeholder-user.png"/>';
							}
							else{
							echo '<img class="albumPhoto" id="'.$profilePictureName.'"height="200px" width="200px" src="data:image/jpeg;base64,'.base64_encode($profilePicture).'"/>';
							}
							echo "<br/><h4>User Reviews</h4><hr/>";
              echo "<div class='row' id='scrollReview'>";//TAKE THIS OUT
							while ($row2 = mysqli_fetch_array($result2)) {
								$queryAlbumInfo = "SELECT albumName, albumArtist, albumPhotoName, albumPhoto FROM Albums WHERE albumID=".$row2[0];
								if($result3 = mysqli_query($databaseConnect, $queryAlbumInfo)){
								while($row3 = mysqli_fetch_array($result3)){
									echo "<div class='row'><div class='col-md-6'>Album Name: ".$row3[0]."<br/>";
									echo "Album Artist: ".$row3[1]."<br/>";
								}
								echo "Rating: ".$row2[1]."<br/></div>";
								echo '<div class="col-md-3 col-offset-md-3">';
                echo '</div></div>';
								echo '<div class="row"><div class="col-md-12">Description: '.$row2[2];
								echo "</div></div><hr/>";
								}
							}
              echo "</div>";//TAKE THIS OUT
              ?>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">

				</div>
			</div>
			<input type="hidden" name="userID" id="userID" value="<?php echo $userID; ?>">
		</div>
	</form>
	<?php
	mysqli_free_result($result);
	mysqli_free_result($result2);
	if($result3){
	mysqli_free_result($result3);
	}
	$databaseConnect->close();
	?>
    </div>
  </div>
</body>
</html>
