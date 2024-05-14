<?php
require_once '../../core/config.php';

$task_id = $mysqli_connect->real_escape_string($_POST['task_id']);
$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE task_id='$task_id'") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch->fetch_array() ){
    
	$list = array(); 
    $list['count'] = $count++;
    $list['assigned_task_id'] = $row['assigned_task_id'];
    $list['comment'] = $row['comment'];
    $list['full_name'] = getUser($row['user_id']);
	array_push($response['data'], $list);
}

echo json_encode($response);

?>