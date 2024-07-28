<?php
require_once '../core/config.php';
$task_status = $_POST['task_status'];

if($task_status == "-1"){
    $query = "";
}else{
    $query = "WHERE status='$task_status'";
}

$fetch = $mysqli_connect->query("SELECT * FROM tbl_tasks $query") or die(mysqli_error());
$count = 1;
while($row = $fetch->fetch_array()){
    $fetchDetails = $mysqli_connect->query("SELECT *,count(assigned_task_id) as total FROM tbl_assigned_tasks WHERE task_id='$row[task_id]'") or die(mysqli_error());
    $dRow = $fetchDetails->fetch_array();
    if ($row['status'] == "P") {
        $status = "<span class='btn btn-inverse-warning btn-fw btn-sm'>Pending</span>";
    } else if ($row['status'] == "O") {
        $status = "<span class='btn btn-inverse-info btn-fw btn-sm'>Ongoing</span>";
    } else if ($row['status'] == "F") {
        $status = "<span class='btn btn-inverse-success btn-fw btn-sm'>Finished</span>";
    }

    $fetchFiles = $mysqli_connect->query("SELECT count(f.file_id) as total FROM tbl_assigned_tasks a LEFT JOIN tbl_assigned_task_files f ON a.assigned_task_id=f.assigned_task_id WHERE a.task_id='$row[task_id]' GROUP BY a.user_id") or die(mysqli_error());
    $fRow = $fetchFiles->fetch_array();
    $stat_total =  $fRow['total'] > 0 ? $fRow['total']."/".$dRow['total']  : "0/".$dRow['total'];
?>

    <tr>
        <td><?= $count++ ?></td>
        <td><?= $row['task_title'] ?></td>
        <td><?= $dRow['total'] ?></td>
        <td><?= $stat_total ?></td>
        <td><?= $status ?></td>
    </tr>

<?php } ?>