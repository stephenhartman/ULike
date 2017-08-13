<?php
  include("databaseConnect.php");
if(isset($_POST['submitData'])){
  //Image Upload
  $image_name = addslashes($_FILES['profilePicture']['name']);
  $image = addslashes(@file_get_contents($_FILES['profilePicture']['tmp_name'])); //SQL Injection defence!

	$username = $_POST["username"];
  $password = $_POST["password"];
	$firstName = $_POST["firstName"];
	$lastName= $_POST["lastName"];
	$location = $_POST["locationState"];
	$email = $_POST["email"];

  /* Check for blank fields exept profile picture*/
  $required = array('username', 'password', 'firstName', 'lastName', 'locationState', 'email');

  $error = false;
      foreach($required as $field) {
      if (empty($_POST[$field])) {
        $error = true;
        }
      }

      if($error || ($image === FALSE)){
        header("Location: registerAdrian.php?error=1");
        }
        if(!$error){
              move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
              $sqlinsert = "INSERT INTO Users (username, password, firstName, lastName, locationState, email, profilePictureName, profilePicture) VALUES ('$username','$password', '$firstName', '$lastName', '$location', '$email', '{$image_name}','{$image}')";
              $_POST = array();
                if(!mysqli_query($databaseConnect, $sqlinsert)){
                  die('Error inserting new record. Please click here <a href="register.php">Register </a>');
                }
                header("Location: signIn.php?error=11");
              }

      }

//     $query = "SELECT username FROM Users";
//     $result = mysqli_query($databaseConnect, $query);
//
//     /* Makes sure user name does not already exists */
//     while ($record = mysqli_fetch_array($result)) {
//         $username = $record[0];
//         if($username == $myuser)
//         {
// 			header("Location: register.php?error=9");
// 			exit;
//         }
//     }
//
// 	$emailB = filter_var($emailB, FILTER_SANITIZE_EMAIL);
// 	/* Validates email */
// 	if(filter_var($emailB, FILTER_VALIDATE_EMAIL) === "false" || $emailB != $email){
// 		header("Location: register.php?error=10");
// 		exit;
// 	}
//

    mysqli_close($databaseConnect);
?>
