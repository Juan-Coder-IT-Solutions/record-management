<?php
require_once '../core/config.php';
$program_name = $mysqli_connect->real_escape_string($_POST['program_name']);
$type = $mysqli_connect->real_escape_string($_POST['type']);
// $user_id  = $_SESSION['rm_user_id'];

$program_id = $mysqli_connect->real_escape_string($_POST['program_id']);
$date = getCurrentDate();

if($type == "add"){
    
    $checker = $mysqli_connect->query("SELECT * FROM tbl_programs WHERE program_name='$program_name'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();

    if ($count_rows && $count_rows[0] > 0) {
        echo 2;
    }else{
        $sql = $mysqli_connect->query("INSERT INTO tbl_programs SET program_name='$program_name',date_added='$date'") or die(mysqli_error());
       
        if($sql){
            $t_id = $mysqli_connect->insert_id;
            echo 1;
        }else{
            echo 0;
        }
    }
}else{
    $checker = $mysqli_connect->query("SELECT * FROM tbl_programs WHERE program_name='$program_name' AND program_id  != '$program_id'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if($count_rows && $count_rows[0] > 0){
        echo 2;
    }else{
        $sql = $mysqli_connect->query("UPDATE tbl_programs SET program_name='$program_name' WHERE program_id ='$program_id'") or die(mysqli_error());
        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>
