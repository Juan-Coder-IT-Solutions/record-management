<?php
require_once '../../core/config.php';
$fetch = $mysqli_connect->query("SELECT * FROM tbl_users") or die(mysqli_error());
$response['data'] = array();
$count = 1;
// $user_id = $_SESSION['rm_user_id'];
while( $row = $fetch->fetch_array() ){

    if($row['user_category'] == "S"){
        $category = "Staff";
    }else if($row['user_category'] == "D"){
        $category = "Dean";
    }else if($row['user_category'] == "R"){
        $category = "Registrar";
    }else if($row['user_category'] == "F"){
        $category = "Faculty";
    }else{
        $category = "Program Chair";
    }
    
	$list = array(); 
    $list['count'] = $count++;
    $list['user_id'] = $row['user_id'];
    $list['full_name'] = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
    $list['program'] = program_name($row['program_id']);
    $list['designation'] = $row['designation'];
    $list['academic_rank'] = $row['academic_rank'];
    $list['category'] = $category;
    $list['date_added'] = date('F d,Y', strtotime($row['date_added']));
	array_push($response['data'], $list);
}

echo json_encode($response);

?>