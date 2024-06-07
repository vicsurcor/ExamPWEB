<?php
// Check if a file was uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    // Allowed file extensions
    $allowed_extensions = array("pdf");
    // Maximum file size limit (e.g., 10 MB)
    $max_file_size = 10 * 1024 * 1024; // 10 MB in bytes

    // Check file extension and size
    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "Sorry, only PDF files are allowed.";
    } elseif ($file_size > $max_file_size) {
        echo "Sorry, the file size exceeds the maximum limit of 10 MB.";
    } else {
        // Define the target directory and file name
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file_name);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file_tmp, $target_file)) {
            echo "File uploaded successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    echo "No file uploaded or there was an error with the upload.";
}
?>
