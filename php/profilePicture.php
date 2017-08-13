<?php

      //Image Upload
      $image_name = addslashes($_FILES['profilePicture']['name']);
      $image = addslashes(@file_get_contents($_FILES['profilePicture']['tmp_name'])); //SQL Injection defence!

      //Variables
      $username = $_POST['username'];

      if(!$username || ($image==FALSE)){
        header("Location: adminBackProfilePic.php?error=1");
      }else{

      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
      $sqlinsert = "INSERT INTO Users (profilePictureName, profilePicture) VALUES ('{$image_name}','{$image}') WHERE username=".$username;

      if(!mysqli_query($databaseConnect, $sqlinsert));
        die('Error inserting new record. Please click here <a href="adminBackProfilePic">Admin Profile Picture </a>');
      }
        header("Location: adminBackProfilePic.php?success=1");
      

 ?>
