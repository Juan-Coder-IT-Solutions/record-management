<?php
require_once '../core/config.php';
$task_title = $mysqli_connect->real_escape_string($_POST['task_title']);
$task_desc = $mysqli_connect->real_escape_string($_POST['task_desc']);
$posted_date = $mysqli_connect->real_escape_string($_POST['posted_date']);
$deadline_date = $mysqli_connect->real_escape_string($_POST['deadline_date']);
$type = $mysqli_connect->real_escape_string($_POST['type']);
$user_id  = $_SESSION['rm_user_id'];

$task_id = $mysqli_connect->real_escape_string($_POST['task_id']);
$date = getCurrentDate();

if($type == "add"){
    
    $checker = $mysqli_connect->query("SELECT * FROM tbl_tasks WHERE task_title='$task_title'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();

    if ($count_rows && $count_rows[0] > 0) {
        echo 2;
    }else{
        $sql = $mysqli_connect->query("INSERT INTO tbl_tasks SET task_title='$task_title',task_desc='$task_desc',posted_date='$posted_date',deadline_date='$deadline_date', user_id='$user_id'") or die(mysqli_error());
       
        if($sql){
            $t_id = $mysqli_connect->insert_id;
            echo 1;
        }else{
            echo 0;
        }
    }
}else{
    $checker = $mysqli_connect->query("SELECT * FROM tbl_tasks WHERE task_title='$task_title' AND task_id  != '$task_id'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if($count_rows && $count_rows[0] > 0){
        echo 2;
    }else{
        $sql = $mysqli_connect->query("UPDATE tbl_tasks SET task_title='$task_title',task_desc='$task_desc',posted_date='$posted_date',deadline_date='$deadline_date' WHERE task_id ='$task_id'") or die(mysqli_error());
        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>
