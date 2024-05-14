<?php
require_once '../core/config.php';
$old_password = $mysqli_connect->real_escape_string($_POST['old_password']);
$new_password = $mysqli_connect->real_escape_string($_POST['new_password']);
$confirm_password = $mysqli_connect->real_escape_string($_POST['confirm_password']);

$user_id  = $_SESSION['rm_user_id'];

$checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE password=md5($old_password) AND user_id = '$user_id '") or die(mysqli_error());
$count_rows = $checker->fetch_array();
if($count_rows && $count_rows[0] > 0){
    echo 2;
}else{
    $sql = $mysqli_connect->query("UPDATE tbl_users SET password=md5('$new_password') WHERE user_id ='$user_id'") or die(mysqli_error());
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}
?>
