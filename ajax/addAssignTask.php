<?php
require_once '../core/config.php';
$user_ids = $_POST['user_id'];
$task_id = $mysqli_connect->real_escape_string($_POST['task_id']);
$encoded_by  = $_SESSION['rm_user_id'];

$date = getCurrentDate();
foreach ($user_ids as $user_id) {
    $user_id = $mysqli_connect->real_escape_string($user_id);
    
    $checker = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE task_id='$task_id' AND user_id='$user_id'") or die(mysqli_error());
    $count_rows = $checker->num_rows;

    if ($count_rows <= 0 ) {
        $sql = $mysqli_connect->query("INSERT INTO tbl_assigned_tasks (task_id, user_id, status, date_assigned, encoded_by) VALUES ('$task_id', '$user_id', 'P', '$date', '$encoded_by')") or die(mysqli_error());
        if($sql){
            $assigned_task_id = $mysqli_connect->insert_id;
            add_notifications($user_id, $task_id, $assigned_task_id, 'Assigned Task');
        }
    }
}

echo 1;

// $checker = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE task_id='$task_id' AND user_id='$user_id'") or die(mysqli_error());
// $count_rows = $checker->fetch_array();

// if ($count_rows && $count_rows[0] > 0) {
//     echo 2;
// } else {
//     $sql = $mysqli_connect->query("INSERT INTO tbl_assigned_tasks SET task_id='$task_id',user_id='$user_id',status='P',date_assigned='$date'") or die(mysqli_error());

//     if ($sql) {
//         echo 1;
//     } else {
//         echo 0;
//     }
// }
