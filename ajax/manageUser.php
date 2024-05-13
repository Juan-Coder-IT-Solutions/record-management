<?php
require_once '../core/config.php';
$first_name = $mysqli_connect->real_escape_string($_POST['first_name']);
$middle_name = $mysqli_connect->real_escape_string($_POST['middle_name']);
$last_name = $mysqli_connect->real_escape_string($_POST['last_name']);
$user_category = $mysqli_connect->real_escape_string($_POST['user_category']);
$username = $mysqli_connect->real_escape_string($_POST['username']);
$password = $mysqli_connect->real_escape_string($_POST['password']);
$type = $mysqli_connect->real_escape_string($_POST['type']);
$user_id  = $mysqli_connect->real_escape_string($_POST['user_id']);
$academic_rank = $mysqli_connect->real_escape_string($_POST['academic_rank']);
$program_id = $mysqli_connect->real_escape_string($_POST['program_id']);
$designation = $mysqli_connect->real_escape_string($_POST['designation']);

$date = getCurrentDate();
//$user_id = $_SESSION['user_id'];

if($type == "add"){
    
    $checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE username='$username'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if($count_rows && $count_rows[0] > 0){
        echo 2;
    }else{
        $sql = $mysqli_connect->query("INSERT INTO tbl_users SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',user_category='$user_category',username='$username',password=md5('$password'), program_id='$program_id', designation='$designation', academic_rank='$academic_rank', date_added='$date'") or die(mysqli_error());

        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }
}else{
    $checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE username='$username' AND user_id  != '$user_id '") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if($count_rows && $count_rows[0] > 0){
        echo 2;
    }else{
        $sql = $mysqli_connect->query("UPDATE tbl_users SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',user_category='$user_category', program_id='$program_id', designation='$designation', academic_rank='$academic_rank' WHERE user_id ='$user_id '") or die(mysqli_error());
        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>
