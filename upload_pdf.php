<?php
session_start();
include('db.php'); // Database connection

// Check if the user is logged in and has the "teacher" role
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'teacher') {
    header("Location: login.php");
    exit();
}

// Define the directory paths for uploads
$pdfTargetDir = "uploads/books/";
$imageTargetDir = "uploads/images/";

// Create directories if they don't exist
if (!is_dir($pdfTargetDir)) {
    mkdir($pdfTargetDir, 0777, true);
}
if (!is_dir($imageTargetDir)) {
    mkdir($imageTargetDir, 0777, true);
}

// Handle PDF upload
if (isset($_FILES["pdfFile"]) && $_FILES["pdfFile"]["error"] == 0) {
    $pdfFileName = basename($_FILES["pdfFile"]["name"]);
    $pdfFilePath = $pdfTargetDir . $pdfFileName;
    if (!move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $pdfFilePath)) {
        die("Error uploading PDF file.");
    }
} else {
    die("PDF file upload failed.");
}

// Handle image upload
if (isset($_FILES["coverImage"]) && $_FILES["coverImage"]["error"] == 0) {
    $imageFileName = basename($_FILES["coverImage"]["name"]);
    $imageFilePath = $imageTargetDir . $imageFileName;
    if (!move_uploaded_file($_FILES["coverImage"]["tmp_name"], $imageFilePath)) {
        die("Error uploading cover image.");
    }
} else {
    die("Cover image upload failed.");
}

// Store book title, PDF, and image paths in the database
$bookTitle = $_POST['bookTitle'];
$teacher = $_SESSION['username'];

$query = $conn->prepare("INSERT INTO books (title, teacher, pdf_path, image_path) VALUES (?, ?, ?, ?)");
$query->bind_param("ssss", $bookTitle, $teacher, $pdfFilePath, $imageFilePath);
$query->execute();

// Get the ID of the newly inserted book
$bookId = $conn->insert_id;

// Redirect to add_question.php with the new book ID
header("Location: add_question.php?book_id=$bookId");
exit();
