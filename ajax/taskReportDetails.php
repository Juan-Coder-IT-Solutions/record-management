<?php
require_once '../core/config.php';
$task_id = $_POST['task_id'];

$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_tasks WHERE task_id='$task_id'") or die(mysqli_error());
$count = 1;

if ($fetch->num_rows > 0) {
    while($row = $fetch->fetch_array()){
        if($row['status'] == "U") {
            $status = "<span class='btn btn-inverse-info btn-fw btn-sm'>Uploaded</span>";
        } else if ($row['status'] == "A") {
            $status = "<span class='btn btn-inverse-success btn-fw btn-sm'>Approved</span>";
        } else if ($row['status'] == "R") {
            $status = "<span class='btn btn-inverse-danger btn-fw btn-sm'>Revision</span>";
        } else if ($row['status'] == "C") {
            $status = "<span class='btn btn-inverse-primary btn-fw btn-sm'>Checking</span>";
        } else {
            $status = "<span class='btn btn-inverse-warning btn-fw btn-sm'>Not Uploaded</span>";
        }
?>

        <tr>
            <td><?= $count++ ?></td>
            <td><?= getUser($row['user_id']) ?></td>
            <td><?= $row['task_grades'] > 0 ? $row['task_grades'] : "<i>No grade</i>" ?></td>
            <td><?= $status ?></td>
        </tr>

<?php 
    }
} else {
?>

    <tr>
        <td colspan="4" class="text-center"><h3 style="padding: 15px;">No details found.</h3></td>
    </tr>

<?php 
}
?>
