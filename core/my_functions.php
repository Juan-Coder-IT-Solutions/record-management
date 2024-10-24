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

function calculateUploadPercentage($task_id)
{
	global $mysqli_connect;

	// Query to count total number of users assigned to the task
	$total_users_query = "
        SELECT COUNT(*) AS total_users
        FROM tbl_assigned_tasks
        WHERE task_id = $task_id
    ";
	$total_users_result = $mysqli_connect->query($total_users_query);
	$total_users = $total_users_result->fetch_assoc()['total_users'];

	// Query to count the number of users who have uploaded their task
	$uploaded_users_query = "SELECT COUNT(DISTINCT assigned_task_id) AS uploaded_users FROM tbl_assigned_task_files WHERE assigned_task_id IN (SELECT assigned_task_id FROM tbl_assigned_tasks WHERE task_id = $task_id  AND status='A')";
	$uploaded_users_result = $mysqli_connect->query($uploaded_users_query);
	$uploaded_users = $uploaded_users_result->fetch_assoc()['uploaded_users'];

	// Calculate the upload percentage
	$upload_percentage = ($total_users > 0) ? ($uploaded_users / $total_users) * 100 : 0;

	return $upload_percentage > 0 ? $upload_percentage : 0;
}

function getUser($user_id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_users` WHERE user_id = '$user_id'");
	if ($fetchData->num_rows > 0) {

		$row = $fetchData->fetch_array();
		return $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
	} else {
		return "---";
	}
}

function program_name($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT program_name FROM `tbl_programs` WHERE program_id='$id'");
	if ($fetchData->num_rows > 0) {
		$row = $fetchData->fetch_array();
		return $row[0];
	} else {
		return "---";
	}
}

function taskNname($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT task_title FROM `tbl_tasks` WHERE task_id='$id'");
	if ($fetchData->num_rows > 0) {
		$row = $fetchData->fetch_array();
		return $row[0];
	} else {
		return "---";
	}
}

function task_row($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_tasks` WHERE task_id='$id'");
	$row = $fetchData->fetch_array();

	return $row;
}

function assigned_task_row($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_assigned_tasks` WHERE assigned_task_id='$id'");
	$row = $fetchData->fetch_array();

	return $row;
}

function user_row($id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT * FROM `tbl_users` WHERE user_id='$id'");
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

function add_notifications($user_id, $task_id, $assigned_task_id, $title)
{

	global $mysqli_connect;

	$query = $mysqli_connect->query("INSERT INTO tbl_notifications (`user_id`, `task_id`, `title`, `status`, assigned_task_id) VALUES ('$user_id', '$task_id', '$title', 1, '$assigned_task_id')") or die(mysqli_error());

	return $query;
}

function insert_logs($user_id, $module, $remarks, $from = "", $to = "")
{

	global $mysqli_connect;
	$date = getCurrentDate();

	$query = $mysqli_connect->query("INSERT INTO tbl_logs (`remarks`, `module`, `date_added`, `user_id`, updated_from, updated_to) VALUES ('$remarks','$module','$date','$user_id','$from', '$to')") or die(mysqli_error());

	return $query;
}

function total_unread_notification($user_id)
{

	global $mysqli_connect;

	$fetchData = $mysqli_connect->query("SELECT count(notification_id) FROM `tbl_notifications` WHERE user_id='$user_id' AND status='1'");
	$row = $fetchData->fetch_array();

	return $row[0];
}

function taskChecker()
{

	global $mysqli_connect;

	$date_now = getCurrentDate();

	$query = $mysqli_connect->query("UPDATE tbl_tasks SET status = CASE WHEN posted_date <= '$date_now' AND deadline_date > '$date_now' THEN 'O' WHEN posted_date > '$date_now' THEN 'P' WHEN posted_date < '$date_now' AND  deadline_date <= '$date_now' THEN 'F' END");

	$fetch =  $mysqli_connect->query("SELECT  a.* FROM tbl_assigned_tasks a LEFT JOIN tbl_assigned_task_files f ON a.assigned_task_id = f.assigned_task_id  WHERE a.task_status = 'F' AND a.notification_status=0 AND f.assigned_task_id IS NULL");
	while ($row = $fetch->fetch_array()) {
		$update = $mysqli_connect->query("INSERT INTO `tbl_notifications`(`user_id`, `task_id`, `assigned_task_id`, `title`, `status`) VALUES ('$row[user_id]','$row[task_id]','$row[assigned_task_id]','Task Overdue',1)");

		if ($update) {
			$mysqli_connect->query("UPDATE `tbl_assigned_tasks` SET notification_status=1 WHERE assigned_task_id='$row[assigned_task_id]'");
		}
	}

	return $query;
}

function time_ago($datetime)
{
	$now = new DateTime(getCurrentDate());
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	// Calculate weeks and adjust days
	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	// Map of time units
	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);

	// Format time units
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	// Return the largest time unit or 'just now'
	$string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getFilePreview($filePath, $fileName)
{
	$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

	// Base structure for the card
	$card = "<div class='card mb-3' style='width: 250px; border: 1px solid #ccc; border-radius: 5px; overflow: hidden;display: flex; flex-direction: column; align-items: center; justify-content: center;'>
                <div class='card-body' style='padding: 10px;'>";

	// Handle image file types
	if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
		$card .= "
        <div style='cursor:pointer;'>
            <div onclick='openModal(\"$filePath\", \"image\")'>
                <img src='$filePath' alt='Image Preview' class='card-img-top' style='height: 100%; width: auto; max-height: 150px; object-fit: cover;' />
            </div>";
	}
	// Handle PDF file types
	elseif ($fileExtension === 'pdf') {
		$card .= "
        <div style='cursor:pointer;'>
            <div onclick='openModal(\"$filePath\", \"pdf\")'>
                <iframe src='$filePath' style='width: 100%; height: 150px;' frameborder='0'></iframe>
            </div>
        </div>";
	}
	// Handle DOCX file types
	elseif ($fileExtension === 'docx') {
		$card .= "
        <p>No preview available for DOCX.</p>";
	}
	// Handle PPTX file types
	elseif ($fileExtension === 'pptx') {
		$card .= "
        <p>No preview available for PPTX.</p>";
	}
	// Handle audio file types
	elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) {
		$card .= "
        <div style='cursor:pointer;'>
            <div onclick='openModal(\"$filePath\", \"audio\")'>
                <audio controls style='width: 100%;'>
                    <source src='$filePath' type='audio/$fileExtension'>Your browser does not support the audio tag.
                </audio>
            </div>
        </div>";
	}
	// Handle video file types
	elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
		$card .= "
        <div style='cursor:pointer;'>
            <div onclick='openModal(\"$filePath\", \"video\")'>
                <video controls style='width: 100%;'>
                    <source src='$filePath' type='video/$fileExtension'>Your browser does not support the video tag.
                </video>
            </div>
        </div>";
	}
	// Default case for unsupported file types
	else {
		$card .= "<span>Preview not available for this file type.</span>";
	}

	// Add View and Download buttons with inline styles
	$card .= "<div class='mt-2'>
    <center>
                <button onclick=\"window.open('$filePath', '_blank');\" 
                        style='background-color: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;'>
                    View
                </button>
                <a href='$filePath' download 
                   style='background-color: #6c757d; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-left: 5px; display: inline-block; text-decoration: none;'>
                    Download
                </a>
              </div>
              </div></center>
            </div>"; // End of card

	return $card;
}
