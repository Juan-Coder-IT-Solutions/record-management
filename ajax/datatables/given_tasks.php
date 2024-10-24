<?php
require_once '../../core/config.php';
$user_id = $_SESSION['rm_user_id'];
$fetch = $mysqli_connect->query("SELECT * FROM tbl_tasks as t, tbl_assigned_tasks at WHERE t.task_id=at.task_id AND at.user_id='$user_id'") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch->fetch_array() ){
    
	$list = array(); 
    $list['count'] = $count++;
    $list['task_id'] = $row['task_id'];
    $list['assigned_task_id'] = $row['assigned_task_id'];
    $list['task_title'] = $row['task_title'];
    $list['task_desc'] = $row['task_desc'];
    $list['status'] = $row['status'];
    $list['encoded_by'] = getUser($row['user_id']);
    $list['posted_date'] = date('F d,Y h:i:s A', strtotime($row['posted_date']));
    $list['deadline_date'] = date('F d,Y h:i:s A', strtotime($row['deadline_date']));
	array_push($response['data'], $list);
}

echo json_encode($response);

?>