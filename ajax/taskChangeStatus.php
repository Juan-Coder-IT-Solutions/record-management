<?php
require_once '../core/config.php';
$user_id = $mysqli_connect->real_escape_string($_POST['user_id']);
$task_id = $mysqli_connect->real_escape_string($_POST['task_id']);
$status = $mysqli_connect->real_escape_string($_POST['status']);
$assigned_task_id = $mysqli_connect->real_escape_string($_POST['assigned_task_id']);
// $user_id  = $_SESSION['rm_user_id'];

$sql = $mysqli_connect->query("UPDATE `tbl_assigned_tasks` SET status='$status' WHERE assigned_task_id='$assigned_task_id'") or die(mysqli_error());
if ($sql) {
    if($status == "A"){
        $title = "Task Approved";
    }else if ($status == "C"){
        $title = "Task Under Review";
    }else if ($status == "R"){
        $title = "Task Needs Revision";
    }

    add_notifications($user_id, $task_id, $assigned_task_id, $title);
    echo 1;
} else {
    echo 0;
}

