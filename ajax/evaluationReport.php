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
        $fetchTasks = $mysqli_connect->query("SELECT t.task_title, a.task_grades FROM tbl_assigned_tasks a JOIN tbl_tasks t ON a.task_id = t.task_id WHERE a.user_id = '$user_id'") or die(mysqli_error());

        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= getUser($user_id) ?></td>
            <td>
                <?php
                if ($fetchTasks->num_rows > 0) {
                    echo "<ul>";
                    while ($task = $fetchTasks->fetch_array()) {
                        $task_title = $task['task_title'];
                        $task_grades = $task['task_grades'];

                        // Display each task as a list item
                        echo "<li>Task: $task_title | Grade: $task_grades</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No tasks assigned.";
                }
                ?>
            </td>
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
