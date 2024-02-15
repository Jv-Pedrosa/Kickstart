<?php
// Assuming 'db_connect.php' connects to your database
include '../db_connect.php'; 

// Query to get all applications with process_id = 0 and a valid resume_path
$applicants = $conn->query("SELECT * FROM application WHERE process_id = 1 AND resume_path IS NOT NULL AND resume_path != ''");


$zip = new ZipArchive();
$zipFileName = 'all_resumes.zip';

if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
    while ($applicant = $applicants->fetch_assoc()) {
        $resumePath = "../assets/resume/" . $applicant['resume_path'];
        if (file_exists($resumePath)) {
            $zip->addFile($resumePath, basename($resumePath));
        }
    }
    $zip->close();

    // Serve the file for download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="'.basename($zipFileName).'"');
    header('Content-Length: ' . filesize($zipFileName));

    readfile($zipFileName);

    // Optionally, delete the zip file if you do not want it to remain on the server
    unlink($zipFileName);
} else {
    echo 'Failed to create zip file.';
}
?>