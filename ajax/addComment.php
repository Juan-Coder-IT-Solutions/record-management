<?php
require_once '../core/config.php';
$comment = $mysqli_connect->real_escape_string($_POST['comment']);
$assigned_task_id = $mysqli_connect->real_escape_string($_POST['id']);
$user_id  = $_SESSION['rm_user_id'];

$sql = $mysqli_connect->query("INSERT INTO `tbl_comments`(`comment`, `assigned_task_id`, `user_id`) VALUES ('$comment','$assigned_task_id','$user_id')") or die(mysqli_error());
if ($sql) {
    echo 1;
} else {
    echo 0;
}

