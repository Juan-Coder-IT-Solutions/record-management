<?php
require_once '../core/config.php';
$nav_task_id = $_POST['nav_task_id'];
$fetch = $mysqli_connect->query("SELECT * FROM tbl_tasks") or die(mysqli_error());
$response['data'] = array();
while( $row = $fetch->fetch_array() ){
   $active = $nav_task_id==$row['task_id']?'active':'';

    echo "<li class='nav-item'><a class='nav-link $active' aria-current='page' href='#' style='font-size: 12px;' onclick='updateNavTaskID(".$row['task_id'].")'>".$row['task_title']."</a></li>";
}
?>  

