<?php
require_once '../../core/config.php';

$assigned_task_id = $mysqli_connect->real_escape_string($_POST['assigned_task_id']);
$fetch = $mysqli_connect->query("SELECT * FROM tbl_assigned_task_files WHERE assigned_task_id='$assigned_task_id'") or die(mysqli_error());
$response['data'] = array();
$count = 1;

while ($row = $fetch->fetch_array()) {
    $file = "task_files/" . $row['file_name'];
    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $file;
    $list = array();
    $list['count'] = $count++;
    $list['btn_download'] = "<a class='btn btn-primary' href='$file' title='Click to download' download><span class='mdi mdi-download'></span></a>";
    $list['file_id'] = $row['file_id'];
    $list['file_name'] = $row['file_name'];
    $list['date_added'] = date('F d,Y h:i:s A', strtotime($row['date_added']));

    // Add a new field for file preview
    $list['preview'] = getFilePreview($file, $row['file_name']); // Function to determine the preview type

    array_push($response['data'], $list);
}

echo json_encode($response);



// function getFilePreview1($filePath, $fileName) {
//     $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//     $encodedFilePath = urlencode($filePath); // URL encode the file path

//     // Debugging output to check file path
//     error_log("File Path: $filePath");

//     // Handle image file types
//     if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
//         return "<img src='$filePath' alt='Image Preview' style='width: 200px; height: auto;' />";
//     }
//     // Handle PDF file types
//     elseif ($fileExtension === 'pdf') {
//         return "<iframe src='$filePath' style='width: 200px; height: 200px;' frameborder='0'></iframe>";
//     }
//     // Handle DOCX file types with Google Docs Viewer
//     elseif ($fileExtension === 'docx') {
//         return "<iframe src='https://docs.google.com/gview?url=$encodedFilePath&embedded=true' style='width: 90%; height: 200px;' frameborder='0' onerror='this.style.display=\"none\"; alert(\"Error loading preview. Please download the file instead.\");'></iframe>";
//     }
//     // Handle audio file types
//     elseif (in_array($fileExtension, ['mp3', 'wav', 'ogg'])) {
//         return "<audio controls style='width: 200px;'><source src='$filePath' type='audio/$fileExtension'>Your browser does not support the audio tag.</audio>";
//     }
//     // Handle video file types
//     elseif (in_array($fileExtension, ['mp4', 'webm', 'ogg'])) {
//         return "<video controls style='width: 200px;'><source src='$filePath' type='video/$fileExtension'>Your browser does not support the video tag.</video>";
//     }
//     // Handle PowerPoint file types
//     elseif ($fileExtension === 'pptx') {
//         return "<iframe src='https://docs.google.com/gview?url=$encodedFilePath&embedded=true' style='width: 200px; height: 200px;' frameborder='0'></iframe>";
//     } 
//     // Default case for unsupported file types
//     else {
//         return "<span>Preview not available for this file type.</span>";
//     }
// }
