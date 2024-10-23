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
function getFilePreview($filePath, $fileName) {
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Base structure for the card
    $card = "<div class='card mb-3' style='width: 250px; border: 1px solid #ccc; border-radius: 5px; overflow: hidden;'>
                <div class='card-body' style='padding: 10px;'>";

    // Handle image file types
    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
        $card .= "
        <div style='cursor:pointer;'>
            <div onclick='openModal(\"$filePath\", \"image\")'>
                <img src='$filePath' alt='Image Preview' class='card-img-top' style='height: auto; max-height: 150px; object-fit: cover;' />
            </div>
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
                <button onclick=\"window.open('$filePath', '_blank');\" 
                        style='background-color: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;'>
                    View
                </button>
                <a href='$filePath' download 
                   style='background-color: #6c757d; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; margin-left: 5px; display: inline-block; text-decoration: none;'>
                    Download
                </a>
              </div>
              </div>
            </div>"; // End of card

    return $card;
}


?>
