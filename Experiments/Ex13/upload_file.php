<?php

$allowed_types = ['image/gif', 'image/jpeg', 'image/pjpeg'];
$max_file_size = 20000; 

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a file has been uploaded
    if (isset($_FILES['fileUpload'])) {
        $file = $_FILES['fileUpload'];
        
        // Get file details
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_type = $file['type'];
        $file_error = $file['error'];

        // Check for upload errors
        if ($file_error !== UPLOAD_ERR_OK) {
            echo "Error uploading file. Please try again.";
            exit;
        }

        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            echo "Invalid file type. Only .gif, .jpeg, or .pjpeg images are allowed.";
            exit;
        }

        // Validate file size
        if ($file_size > $max_file_size) {
            echo "File size exceeds the allowed limit of 20 KB.";
            exit;
        }
        $upload_dir = 'uploads/';

       
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

       
        $destination = $upload_dir . basename($file_name);

        // Move the uploaded file to the destination
        if (move_uploaded_file($file_tmp, $destination)) {
            echo "File uploaded successfully: <a href='$destination'>View File</a>";
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file selected.";
    }
} else {
    echo "Invalid request.";
}
?>
