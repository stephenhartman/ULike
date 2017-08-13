<?php
  //Connect to the Database
include("databaseConnect.php");
session_start();
$username = $_SESSION["username"];
if ($username == ""){
  header("Location: signIn.php?error=3");
  die();
}
  if(isset($_POST['submitReview'])){
    $userID= $_POST['userID'];
    $albumID = $_POST['albumID'];
    $rating = $_POST['rating'];
    $description = mysqli_escape_string($databaseConnect, $_POST['description']);
    $required = array('userID', 'albumID', 'rating', 'description');

    $error = false;
        foreach($required as $field) {
        if (empty($_POST[$field])) {
          $error = true;
        }
      }

      if($error){
          // echo '<a href="home.php?error=1"> Empty Fields</a>';
          header("Location: home.php?error=1");
        }
              if(!$error){
                $sqlinsert = "INSERT INTO Reviews (userID, albumID, rating, description) VALUES ('$userID','$albumID', '$rating', '$description')";
                $_POST = array();
                  if(!mysqli_query($databaseConnect, $sqlinsert)){
                    printf("Error: %s\n", mysqli_error($databaseConnect));
					die('Error inserting new record. Please click here <a href="home.php">Home </a>');
                  }

                  // echo '<a href="home.php?success=1">Home</a>';
                  header("Location: home.php?success=1");
                }

    }
    //DEBUGGERS
    // echo $userID."<br>";
    // echo $albumID."<br>";
    // echo $rating ."<br>";
    // echo $description."<br>";
  mysqli_close($databaseConnect);
 ?>
