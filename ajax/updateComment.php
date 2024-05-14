<?php
require_once '../core/config.php';
$comment = $mysqli_connect->real_escape_string($_POST['comment']);
$assigned_task_id = $mysqli_connect->real_escape_string($_POST['id']);
// $user_id  = $_SESSION['rm_user_id'];

$sql = $mysqli_connect->query("UPDATE tbl_assigned_tasks SET comment='$comment' WHERE assigned_task_id ='$assigned_task_id'") or die(mysqli_error());
if ($sql) {
    echo 1;
} else {
    echo 0;
}
