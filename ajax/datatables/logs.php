<?php
require_once '../../core/config.php';
$module = $_POST['type'];
$fetch_products = $mysqli_connect->query("SELECT * FROM tbl_logs WHERE module='$module' ORDER BY date_added DESC") or die(mysqli_error());
$response['data'] = array();
$count = 1;
while( $row = $fetch_products->fetch_array() ){
    
	$list = array(); 
    $list['count'] = $count++;
    $list['remarks'] = $row['remarks'];
    $list['updated_from'] = $row['updated_from'];
    $list['updated_to'] = $row['updated_to'];
    $list['encoded_by'] = getUser($row['user_id']);
    $list['date_added'] = date('F d,Y  h:i:s A', strtotime($row['date_added']));
	array_push($response['data'], $list);
}

echo json_encode($response);

?>