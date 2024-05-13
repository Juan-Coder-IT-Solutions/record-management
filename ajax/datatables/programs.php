<?php
require_once '../../core/config.php';
$fetch_products = $mysqli_connect->query("SELECT * FROM tbl_programs") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch_products->fetch_array() ){
    
	$list = array(); 
    $list['count'] = $count++;
    $list['program_id'] = $row['program_id'];
    $list['program_name'] = $row['program_name'];
    $list['date_added'] = date('F d,Y', strtotime($row['date_added']));
	array_push($response['data'], $list);
}

echo json_encode($response);

?>