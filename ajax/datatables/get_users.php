<?php
require_once '../../core/config.php';
$user_category = $_POST['user_category'];
$fetch = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_category = '$user_category'") or die(mysqli_error());
$response['data'] = array();
$count = 1;
// $user_id = $_SESSION['rm_user_id'];
while( $row = $fetch->fetch_array() ){

	$list = array(); 
    $list['user_id'] = $row['user_id'];
    $list['full_name'] = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
	array_push($response['data'], $list);
}

echo json_encode($response);

?>