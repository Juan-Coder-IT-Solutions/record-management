<?php
require_once '../../core/config.php';

$assigned_task_id = $mysqli_connect->real_escape_string($_POST['assigned_task_id']);
$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_task_files WHERE assigned_task_id='$assigned_task_id'") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch->fetch_array() ){
    
    $file = "task_files/".$row['file_name'];
	$list = array(); 
    $list['count'] = $count++;
    $list['btn_download'] = "<a class='btn btn-primary' href='$file' title='Click to download' download><span class='mdi mdi-download'></span></a>";
    $list['file_id'] = $row['file_id'];
    $list['file_name'] = $row['file_name'];
    $list['date_added'] = date('F d,Y', strtotime($row['date_added']));
	array_push($response['data'], $list);
}

echo json_encode($response);

?>