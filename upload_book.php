<?php
session_start();
include('db.php'); // Database connection

// Check if the user is logged in and has the "teacher" role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: login.php");
    exit();
}

// Directory paths for uploads
$pdfTargetDir = "uploads/books/";
$imageTargetDir = "uploads/images/";

if (!is_dir($pdfTargetDir)) {
    mkdir($pdfTargetDir, 0777, true);
}
if (!is_dir($imageTargetDir)) {
    mkdir($imageTargetDir, 0777, true);
}

// Handle PDF upload
$pdfFileName = basename($_FILES["pdfFile"]["name"]);
$pdfFilePath = $pdfTargetDir . $pdfFileName;
move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $pdfFilePath);

// Handle image upload
$imageFileName = basename($_FILES["coverImage"]["name"]);
$imageFilePath = $imageTargetDir . $imageFileName;
move_uploaded_file($_FILES["coverImage"]["tmp_name"], $imageFilePath);

// Store book title, PDF, and image paths in the database
$bookTitle = $_POST['bookTitle'];
$teacher = $_SESSION['username'];

$query = $conn->prepare("INSERT INTO books (title, teacher, pdf_path, image_path) VALUES (?, ?, ?, ?)");
$query->bind_param("ssss", $bookTitle, $teacher, $pdfFilePath, $imageFilePath);
$query->execute();

header("Location: teacher-dashboard.php");
exit();
?>
