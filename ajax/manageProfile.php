<?php
require_once '../core/config.php';
$first_name = $mysqli_connect->real_escape_string($_POST['first_name']);
$middle_name = $mysqli_connect->real_escape_string($_POST['middle_name']);
$last_name = $mysqli_connect->real_escape_string($_POST['last_name']);
$username = $mysqli_connect->real_escape_string($_POST['username']);
$academic_rank = $mysqli_connect->real_escape_string($_POST['academic_rank']);
$designation = $mysqli_connect->real_escape_string($_POST['designation']);
$user_id  = $_SESSION['rm_user_id'];

    $checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE username='$username' AND user_id  != '$user_id '") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if($count_rows && $count_rows[0] > 0){
        echo 2;
    }else{
        $sql = $mysqli_connect->query("UPDATE tbl_users SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name', academic_rank='$academic_rank', designation='$designation' WHERE user_id ='$user_id '") or die(mysqli_error());
        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }
?>
