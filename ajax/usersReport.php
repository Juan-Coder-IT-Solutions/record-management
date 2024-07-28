<?php
require_once '../core/config.php';
$program_id = $_POST['program_id'];

if ($program_id == -1) {
    $query = "";
} else {
    $query = "WHERE program_id='$program_id'";
}

$fetchUsers = $mysqli_connect->query("SELECT * FROM tbl_users $query") or die(mysqli_error());
$count = 1;

if ($fetchUsers->num_rows > 0) {
    while ($user = $fetchUsers->fetch_array()) {
        $user_id = $user['user_id'];
        
        // Fetch assigned tasks for the user
        $fetchTasks = $mysqli_connect->query("SELECT a.task_id, a.status AS task_status, t.deadline_date FROM tbl_assigned_tasks a JOIN tbl_tasks t ON a.task_id = t.task_id WHERE a.user_id = '$user_id'") or die(mysqli_error());

        $alwaysLate = true;
        
        while ($task = $fetchTasks->fetch_array()) {
            $task_id = $task['task_id'];
            $deadline_date = new DateTime($task['deadline_date']);
            
            // Fetch submission files for the assigned task
            $fetchFiles = $mysqli_connect->query("SELECT date_added FROM tbl_assigned_task_files WHERE assigned_task_id = '$task_id'") or die(mysqli_error());

            if ($fetchFiles->num_rows > 0) {
                while ($file = $fetchFiles->fetch_array()) {
                    $submission_date = new DateTime($file['date_added']);
                    
                    if ($submission_date <= $deadline_date) {
                        $alwaysLate = false;
                        break;
                    }
                }
            } else {
                $alwaysLate = false; // No submission, not always late
                break;
            }
        }

        if ($alwaysLate) {
            $status = "<span class='btn btn-inverse-danger btn-fw btn-sm'>Always Late</span>";
        } else {
            $status = "<span class='btn btn-inverse-success btn-fw btn-sm'>On Time</span>";
        }

        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= getUser($user_id) ?></td>
            <td><?= $status ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="3" class="text-center">
            <h3 style="padding: 15px;">No details found.</h3>
        </td>
    </tr>
<?php
}
?>
