<?php
//Connect to the DB firstNameDB
include("databaseConnect.php");
session_start();

$username = $_SESSION["username"];
if ($username == ""){
  header("Location: signIn.php?error=3");
  die();
}

// Prepared statement to prevent SQL injection
$query = "UPDATE Users SET username = ?, firstName = ?, lastName = ?, locationState = ?, email = ? WHERE userID = ?";
if($stmt = $databaseConnect->prepare($query)){
	$stmt->bind_param('sssssi', $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["locationState"], $_POST["email"], $_POST["userID"]);
}
else{
	printf("Errormessage: %s\n", $databaseConnect->error);
}
if($stmt === FALSE) {
	//die("Error: ".mysql_error()); // TODO: better error handling
	$stmt->close();
	$databaseConnect->close();
	header("Location: myProfile.php?error=1");
	die();
}

$stmt->execute();
$stmt->close();
$databaseConnect->close();

header("Location: myProfile.php?error=2");
?>