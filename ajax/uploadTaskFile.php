<?php
include_once '../core/config.php';
$file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder = "../task_files/";
$assigned_task_id  = $_POST['assigned_task_id'];
$task_id  = $_POST['task_id'];
$user_id  = $_POST['user_id'];



$date = getCurrentDate();

// make file name in lower case	
$new_file_name = strtolower($file);
// make file name in lower case

$task_file = str_replace(' ', '-', $new_file_name);
if (move_uploaded_file($file_loc, $folder . $task_file)) {
    $sql = $mysqli_connect->query("INSERT INTO `tbl_assigned_task_files` SET `file_name`='$task_file', assigned_task_id ='$assigned_task_id', date_added='$date'");
    if ($sql) {

        $mysqli_connect->query("UPDATE tbl_assigned_tasks SET status='U' WHERE assigned_task_id ='$assigned_task_id' AND status = ''") or die(mysqli_error());

        $title = getUser($_SESSION['rm_user_id'])." uploaded a file";
        add_notifications($user_id, $task_id, $assigned_task_id, $title);
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
