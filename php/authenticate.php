<?php
    include("databaseConnect.php");

    session_start();
    
     $username = $_POST["username"];	
    $password = $_POST["password"];
     $_SESSION["username"] = $username;

    if($username == "") {
        header("Location: signIn.php?error=1");
        exit;
    }
    if($password == "") {
	header("Location: signIn.php?error=2");
        exit;
    }
	

    $query = "SELECT username, password FROM Users";
    $result = mysqli_query($databaseConnect, $query);

    while ($record = mysqli_fetch_array($result)) {
        $myuser = $record[0];
		$mypass = $record[1];

        if($username == $myuser)
        {
          if($password == $mypass)
          {
            header("Location: home.php");
            exit;
          }
          else {
            header("Location: signIn.php?error=2");
            exit;
          }
        }
    }
    header("Location: signIn.php?error=3");
    mysqli_close($databaseConnect);
?>
