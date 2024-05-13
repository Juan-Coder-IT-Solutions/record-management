<?php
require_once '../core/config.php';

if(isset($_POST['id'])){
	//$id = $mysqli_connect->real_escape_string($_POST['id']);
	$table = $_POST['tb'];
	$keyword = $_POST['keyword'];


	foreach ($_POST['id'] as $values) {
		$fetchData = $mysqli_connect->query("SELECT * FROM $table WHERE $keyword='$values'") or die(mysqli_error());
		$data = $fetchData->fetch_array();
		// if($keyword == "file_id"){
			
		// 	unlink('../assets/training_file/'.$data['file']);
		// }else if($keyword == "training_id"){
		// 	$mysqli_connect->query("DELETE FROM tbl_notifications WHERE training_id='$values'") or die(mysqli_error());
		// }else if($keyword == "pre_assesment_id"){
		// 	$mysqli_connect->query("DELETE FROM tbl_pre_assesment_details WHERE pre_assesment_id='$values'") or die(mysqli_error());
		// }

		$sql = $mysqli_connect->query("DELETE FROM $table WHERE $keyword='$values' ") or die(mysqli_error());
		
	}

	if($sql){
		echo 1;
	}else{
		echo 0;
	}

	$mysqli_connect->close();
	
}

?>