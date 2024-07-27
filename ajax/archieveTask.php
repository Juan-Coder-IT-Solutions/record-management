<?php
require_once '../core/config.php';

foreach ($_POST['id'] as $values) {
	$sql = $mysqli_connect->query("UPDATE tbl_tasks SET hide_status=1 WHERE task_id='$values'") or die(mysqli_error());
}

if($sql){
	echo 1;
}else{
	echo 0;
}

$mysqli_connect->close();

?>