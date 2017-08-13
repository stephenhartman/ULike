<?php
//Connect to the Database
include("databaseConnect.php");
session_start();
$username = $_SESSION['username'];

$albumID = $_GET['albumID'];
// Prepared statement to prevent SQL injection
//Get the userID of current session user
$getUserID = "SELECT userID FROM Users WHERE username ='".$username."'";
$result3 = mysqli_query($databaseConnect, $getUserID);
if(!$result3){
	printf($getUserID);
	printf("Error: %s\n", mysqli_error($databaseConnect));
}
while ($row = mysqli_fetch_array($result3)) {
        $userID = $row[0];
}

//Get User ID of album submitter
$getUser = "SELECT userID FROM Albums WHERE albumID =".$albumID;
$result1 = mysqli_query($databaseConnect, $getUser);
while ($row = mysqli_fetch_array($result1)) {
        $userIDAlbum = $row[0];
}
//Get Username of album submitter
$getUsername = "SELECT username FROM Users WHERE userID =".$userIDAlbum;
$result2 = mysqli_query($databaseConnect, $getUsername);
while ($row = mysqli_fetch_array($result2)) {
        $usernameAlbum = $row[0];
}

//Get Album Information
$queryAlbum = "SELECT albumName, albumArtist, albumYear, albumGenre, spotifyLink, albumPhoto FROM Albums WHERE albumID=".$albumID;
$result = mysqli_query($databaseConnect, $queryAlbum);

//Get average rating
$queryAverage = "SELECT AVG(rating) FROM Reviews WHERE albumID=".$albumID;
$resultAverage = mysqli_query($databaseConnect, $queryAverage);
while ($row = mysqli_fetch_array($resultAverage)) {
        $avgRating = $row[0];
}
$averageRating = round($avgRating, 1);

//Reviews
$getUsername = "SELECT userID, albumID, rating, description FROM Reviews WHERE albumID =".$albumID;
$result4 = mysqli_query($databaseConnect, $getUsername);


mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_free_result($resultAverage);
 ?>

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
   <script src="../js/backHome.js"></script>
   <script src="../js/rateYo.js"></script>
 </head>
 <body id="body">
   <!--THIS IS WHERE ALL CODE GOES-->
   <div id="main">
     <div class="container">
       <!--* * * * * * * * * * * *EDITED BY ADRIAN* * * * * * * * * * * * * * * * *-->
       <div class="row">
				 <!--* * * * * * * * * *ALERT SYSTEM * * * * * * * * * * * -->
         <div class="col-md-5">
           <div id="uploadResult">
             <br>
             <!-- <img id="img-upload-reflect" width="50%" height="50%"/>
             <br> -->
            <?php
            while($row = mysqli_fetch_array($result)){
             echo '<img class="albumPhoto" height="250px" width="250px" src="data:image/jpeg;base64,'.base64_encode($row["albumPhoto"] ).'"/>';
             echo '<br>';
             echo '<h4>Added by: <b><small class="small-reflect"> '.$usernameAlbum .'</small></b></h4>';
             echo '<h4>Album Name: <b><small class="small-reflect" id="albumNameReflect">'.$row["albumName"] .'</small></b></h4>';
             echo '<h4>Artist Name: <b><small class="small-reflect" id="artistReflect">'.$row["albumArtist"] .'</small></b></h4>';
             echo '<h4>Album Year: <b><small class="small-reflect" id="dateReflect">'.$row["albumYear"]. '</small></b></h4>';
             echo '<h4>Album Genre: <b><small class="small-reflect" id="genreReflect">'.$row["albumGenre"] .'</small></b></h4>';
             echo '<h4> Spotify Link: <b><small class="small-reflect" id="spotifyLinkReflect"><a target="_blank" href="' .$row["spotifyLink"].'">' .$row["albumName"] .'</a></small></b></h4>';
						 echo '<br>';
            }
            mysqli_free_result($result);
            ?>
           </div>
					 <br>
		   <a href="home.php" id="backHome" class ="btn btn-success btn-lg btn-block" role="button">Back to Albums</a>
         </div>
         <div class="col-md-7">
           <div class="row">
             <!-- Add Review Goes here-->
             <form method="post">
						<!--Ratings will be placed here here-->
						<h4>Rate this album:</h4>	
               <label class="radio-inline"><input type="radio" name="rating" value="1"/>1</label>
               <label class="radio-inline"><input type="radio" name="rating" value="2"/>2</label>
               <label class="radio-inline"><input type="radio" name="rating" value="3"/>3</label>
               <label class="radio-inline"><input type="radio" name="rating" value="4"/>4</label>
               <label class="radio-inline"><input type="radio" name="rating" value="5"/>5</label>
               <br/>
			   <h4>Provide a description of your review:</h4>
               <textarea class="form-control" rows="5" name="description"></textarea>
               <br>
               <!--We will store the username here-->
               <input type="hidden" name="userID" value="<?php echo $userID?>"></input>
               <!--We will store the albumID here-->
               <input type="hidden" name="albumID" value="<?php echo $albumID?>"></input>
               <button type="submit" class="btn btn-add-review btn-large btn-block" formaction="addReview.php" name="submitReview">Submit Review</button>
             </form>
			 <br/>
			 <?php echo '<h4>Average Rating: '.$averageRating;'</h4>' ?>
           </div>
           <br>
           <div class="row" id="scrollReview">
             <!-- All Reviews Go here-->
						 <?php
						 while ($row = mysqli_fetch_array($result4)) {
							 $userQuery = "SELECT username FROM Users WHERE userID=".$row[0];
							 $result5 = mysqli_query($databaseConnect, $userQuery);
							 while ($row2 = mysqli_fetch_array($result5)) {
								 echo "User: ".$row2[0] ."<br>";
							 }
							 mysqli_free_result($result5);
								echo "rating: ".$row[2] ."<br>";
								echo "description: ".$row[3] ."<br>";
								echo "<hr>";
						 }
						 mysqli_free_result($result4);
						 $databaseConnect->close();
						 ?>
           </div>
           </div>
         </div>
       </div>
     </div>
 </body>
 </html>
