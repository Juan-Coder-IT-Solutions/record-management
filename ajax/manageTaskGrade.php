<?php
require_once '../core/config.php';
$task_grades = $mysqli_connect->real_escape_string($_POST['task_grades']);
$assigned_task_id = $mysqli_connect->real_escape_string($_POST['assigned_task_id']);
$encoded_by  = $_SESSION['rm_user_id'];
$row = assigned_task_row($assigned_task_id);
$task_name = taskNname($row['task_id']);

$remarks = getUser($encoded_by)." submitted you a grade in Task: ".$task_name;

$date = getCurrentDate();
$sql = $mysqli_connect->query("UPDATE `tbl_assigned_tasks` SET task_grades='$task_grades' WHERE assigned_task_id='$assigned_task_id'") or die(mysqli_error());
if ($sql) {
    add_notifications($row['user_id'], $row['task_id'], $assigned_task_id, $remarks);
    echo 1;
}else{
    echo 0;
}
