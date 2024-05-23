<?php
require_once '../../core/config.php';

$task_status    = $_POST['task_status'];
$task_id        = $_POST['task_id'];
$param          = $task_status=="A"?"":(($task_status=="OT")?" AND atf.date_added <= t.deadline_date":(($task_status=="LS")?" AND atf.date_added > t.deadline_date":(($task_status=="NS")?" AND atf.assigned_task_id IS NULL":"")));

$fetch = $mysqli_connect->query("SELECT t.user_id AS encoded_by, at.user_id AS faculty, t.task_title, t.task_desc, t.posted_date, t.deadline_date, atf.file_name, atf.date_added FROM tbl_tasks t LEFT JOIN tbl_assigned_tasks at ON t.task_id=at.task_id LEFT JOIN tbl_assigned_task_files atf ON at.assigned_task_id=atf.assigned_task_id WHERE t.task_id='$task_id' $param") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch->fetch_array() ){
    
	$list                       = array(); 
    $list['count']              = $count++;
    $list['encoded_by']         = getUser($row['encoded_by']);
    $list['faculty_name']       = $row['faculty']==NULL?"<span style='color:red;white-space: nowrap;'><span class='mdi mdi-alert'></span> No Assigned Faculty</span>":getUser($row['faculty']);

    $list['task_title']         = $row['task_title'];
    $list['task_desc']          = $row['task_desc'];

    $list['file_name']          = $row['file_name']==NULL?"<span style='color:red;white-space: nowrap;'><span class='mdi mdi-alert'></span> No Data found</span>":$row['file_name'];
    $list['submission_date']    = $row['date_added']==NULL?"<span style='color:red;white-space: nowrap;'><span class='mdi mdi-alert'></span> No Data found</span>":date('F d,Y', strtotime($row['date_added']));
  
    $list['posted_date']        = date('F d,Y', strtotime($row['posted_date']));
    $list['deadline_date']      = date('F d,Y', strtotime($row['deadline_date']));

	array_push($response['data'], $list);
}

echo json_encode($response);

?>