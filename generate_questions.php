<?php
include('db.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfFile'])) {
    $bookTitle = $_POST['bookTitle'];
    $targetDir = "uploads/";
    $pdfPath = $targetDir . basename($_FILES["pdfFile"]["name"]);
    
    // Upload PDF
    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $pdfPath)) {
        // Save the book in the `books` table
        $stmt = $conn->prepare("INSERT INTO books (title, file_path) VALUES (?, ?)");
        $stmt->bind_param("ss", $bookTitle, $pdfPath);
        $stmt->execute();
        $bookId = $stmt->insert_id;
        
        echo "PDF uploaded successfully!<br>";
        echo "<a href='add_question.php?book_id=$bookId'>Add Questions for This Book</a>";
    } else {
        echo "Error uploading PDF.";
    }
}
?>

<!-- HTML Form for Uploading PDF -->
<div id="loadingSpinner" class="spinner-container">
    <div class="spinner"></div>
</div>
<form action="generate_questions.php" method="post" enctype="multipart/form-data">
    <label for="bookTitle">Book Title:</label>
    <input type="text" id="bookTitle" name="bookTitle" required>
    
    <label for="pdfFile">Select PDF file:</label>
    <input type="file" id="pdfFile" name="pdfFile" accept=".pdf" required>
    
    <button type="submit">Upload PDF</button>
</form>
