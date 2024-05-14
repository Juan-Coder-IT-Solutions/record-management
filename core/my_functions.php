<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}

function getUser($user_id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_users` WHERE user_id = '$user_id'");
	if($fetchData->num_rows > 0){

		$row = $fetchData->fetch_array();
		return $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
	}else{
		return "---";
	}
}

function program_name($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT program_name FROM `tbl_programs` WHERE program_id='$id'");
	$row = $fetchData->fetch_array();

	return $row[0];
}

function task_row($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_tasks` WHERE task_id='$id'");
	$row = $fetchData->fetch_array();

	return $row;
}

function total_task()
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT count(task_id) FROM `tbl_tasks`");
	$row = $fetchData->fetch_array();

	return $row[0];
}

function total_user()
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT count(user_id) FROM `tbl_users`");
	$row = $fetchData->fetch_array();

	return $row[0];
}

function total_program()
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT count(program_id) FROM `tbl_programs`");
	$row = $fetchData->fetch_array();

	return $row[0];
}