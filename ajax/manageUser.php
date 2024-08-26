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

if ($type == "add") {

    $checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE username='$username'") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if ($count_rows && $count_rows[0] > 0) {
        echo 2;
    } else {
        $sql = $mysqli_connect->query("INSERT INTO tbl_users SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',user_category='$user_category',username='$username',password=md5('$password'), program_id='$program_id', designation='$designation', academic_rank='$academic_rank', date_added='$date'") or die(mysqli_error());

        if ($sql) {
            insert_logs($_SESSION['rm_user_id'], 'Users', 'Added new user (' . $first_name . " " . $middle_name . " " . $last_name . ")");
            echo 1;
        } else {
            echo 0;
        }
    }
} else {
    $checker = $mysqli_connect->query("SELECT * FROM tbl_users WHERE username='$username' AND user_id  != '$user_id '") or die(mysqli_error());
    $count_rows = $checker->fetch_array();
    if ($count_rows && $count_rows[0] > 0) {
        echo 2;
    } else {
        $current_user = $mysqli_connect->query("SELECT * FROM tbl_users WHERE user_id = '$user_id'") or die($mysqli_connect->error);
        $current_data = $current_user->fetch_assoc();

        $log_message = "Updated user details: ";
        $updates_made = false;
        $update_fields = [];
        if ($first_name !== $current_data['first_name']) {
            $log_message .= "First Name changed from ".$current_data['first_name']." to ".$first_name.", ";
            $updates_made = true;
        }
        if ($middle_name !== $current_data['middle_name']) {
            $log_message .= "Middle Name changed from ".$current_data['middle_name']." to ".$middle_name.", ";
            $updates_made = true;
        }
        if ($last_name !== $current_data['last_name']) {
            $log_message .= "Last Name changed from '{$current_data['last_name']}' to ".$last_name.", ";
            $updates_made = true;
        }
        if ($program_id !== $current_data['program_id']) {
            $log_message .= "program_id changed from ".program_name($current_data['program_id'])." to ".program_name($program_id).", ";
            $updates_made = true;
        }
        if ($designation !== $current_data['designation']) {
            $log_message .= "Designation changed from ".$current_data['designation']." to ".$designation.", ";
            $updates_made = true;
        }
        if ($academic_rank !== $current_data['academic_rank']) {
            $log_message .= "Academic Rank changed from ".$current_data['academic_rank']." to ".$academic_rank.", ";
            $updates_made = true;
        }


        $sql = $mysqli_connect->query("UPDATE tbl_users SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',user_category='$user_category', program_id='$program_id', designation='$designation', academic_rank='$academic_rank' WHERE user_id ='$user_id '") or die(mysqli_error());
        if ($sql) {
            // insert_logs($_SESSION['rm_user_id'], 'Users', 'Updated user details (' . $first_name . " " . $middle_name . " " . $last_name . ")");
            if ($updates_made) {
                insert_logs($_SESSION['rm_user_id'], 'Users', rtrim($log_message, ', '));
            }
            echo 1;
        } else {
            echo 0;
        }
    }
}
