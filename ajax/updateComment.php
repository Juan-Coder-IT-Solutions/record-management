<?php
require_once '../core/config.php';
$comment = $mysqli_connect->real_escape_string($_POST['comment']);
$assigned_task_id = $mysqli_connect->real_escape_string($_POST['id']);
// $user_id  = $_SESSION['rm_user_id'];

$row = assigned_task_row($assigned_task_id);

$sql = $mysqli_connect->query("UPDATE tbl_assigned_tasks SET comment='$comment' WHERE assigned_task_id ='$assigned_task_id'") or die(mysqli_error());
if ($sql) {
    insert_logs($user_id, 'Tasks', 'Added comment ('.taskNname($row['task_id'])." - ".getUser($row['user_id']).")");
    echo 1;
} else {
    echo 0;
}

