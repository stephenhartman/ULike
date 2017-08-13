<?php
    include("databaseConnect.php");

if(isset($_POST['SubmitData'])) {	
	$myuser = trim($_POST["username"]);
    	$mypass = trim($_POST["password"]);
	$myfn = trim($_POST["firstName"]);
	$myln = trim($_POST["lastName"]);
	$mylocation = trim($_POST["locationState"]);
	$myemail = trim($_POST["email"]);

/* Check for blank fields exept profile picture*/
	if(empty($myuser) || empty($mypass) || empty($myfn) || empty($myln) || empty(mylocation) || empty(myemail) ) {
		header("Location: register.php?error=1");
		exit;
	}
	



	/* Checks to make sure first name, last name, and location only has alphabet characters */
	function hasOnlyLetters($str) {
		return preg_match('/^[a-zA-Z\s]+$/', $str);
	}
	
	if(!hasOnlyLetters($myfn)){
		header("Location: register.php?error=6");
		exit;
	}
	else if(!hasOnlyLetters($myln)){
		header("Location: register.php?error=7");
		exit;
	}
	else if(!hasOnlyLetters($mylocation)){
		header("Location: register.php?error=8");
		exit;
	}
	else {
	}
    

    $query = "SELECT username FROM Users";
    $result = mysqli_query($databaseConnect, $query);

    /* Makes sure user name does not already exists */
    while ($record = mysqli_fetch_array($result)) {
        $username = $record[0];

        if($username == $myuser)
        {
			header("Location: register.php?error=9");
			exit;
        }
    }
	
	$emailB = filter_var($emailB, FILTER_SANITIZE_EMAIL);
	/* Validates email */
	if(filter_var($emailB, FILTER_VALIDATE_EMAIL) === "false" || $emailB != $email)
	{
		header("Location: register.php?error=10");
		exit;
	}
    
	$stmt = $databaseConnect->prepare("INSERT INTO Users (username, password, firstName, lastName, locationState, email) VALUES (?, ?, ?, ?, ?, ?)");        
	$stmt-> bind_param("ssssss", $myuser, $mypass, $myfn, $myln, $mylocation, $myemail);

    $stmt->execute();
    $stmt->close();

    header("Location: signIn.php?error=11");
}
    mysqli_close($databaseConnect);

?>
