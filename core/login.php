<?php
require_once '../core/config.php';

	$userlogin = $_POST['userlogin'];
	$userpassword = $_POST['userpassword'];

		/*if(passwordHashing == true)
		{
			$userpassword =  clean($_POST['userpassword']);
		}else
		{
			$userpassword = clean($_POST['userpassword']);
		}*/

	$host 	  = host;
	$username = username;
	$password = password;
	$database = database;
	$user_connect = new mysqli($host, $username, $password, $database);

	$query = "SELECT * FROM ";
	$query .= table;
	$query .=" WHERE username = '$userlogin' AND password = md5('$userpassword')";

	$result = $user_connect->query($query) or die (mysqli_error());

	if($result->num_rows == 1){
	

		$row = $result->fetch_assoc();
		$_SESSION['rm_user_id'] = $row['user_id'];
		$_SESSION['user_category'] = $row['user_category'];
		
		//header("Location:../index.php");
		echo 1;
		exit;

		$user_connect->close();
	}else {
		$_SESSION['error']  = error_message;
		echo "Account not valid";
		//header("Location:../auth/login.php");
		exit;
	}

?>