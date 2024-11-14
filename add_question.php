<?php
include('db.php'); // Database connection


$bookId = $_GET['book_id']; // Assuming book_id is passed in the URL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get question and options from the form
    $questionText = $_POST['questionText'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $correctAnswer = $_POST['correctAnswer'];

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['questionImage']) && $_FILES['questionImage']['error'] == 0) {
        $targetDir = "uploads/questions/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $imagePath = $targetDir . basename($_FILES["questionImage"]["name"]);
        move_uploaded_file($_FILES["questionImage"]["tmp_name"], $imagePath);
    }

    // Insert question into `questions` table
    $query = $conn->prepare("INSERT INTO questions (book_id, question, option_a, option_b, option_c, option_d, correct_answer, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("isssssss", $bookId, $questionText, $optionA, $optionB, $optionC, $optionD, $correctAnswer, $imagePath);
    $query->execute();

    echo "<p style='color: green; text-align: center;'>Question added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to style.css -->
</head>
<body>
<div id="loadingSpinner" class="spinner-container">
    <div class="spinner"></div>
</div>
<!-- Navbar and Header -->
<div id="navbar">
    <?php include('navbar.php'); ?>
</div>

<!-- Dynamic Content Area -->
<div id="content">
    <!-- Initial content goes here or via AJAX -->
</div>
<!-- Main Content Wrapper to ensure spacing from navbar -->
<div class="main-content">
    <div class="question-form-container">
        <h2>Add a Question</h2>
        
        <!-- HTML Form for Adding a Question -->
        <form action="add_question.php?book_id=<?php echo $bookId; ?>" method="post" enctype="multipart/form-data">
            <label for="questionText">Question:</label>
            <textarea id="questionText" name="questionText" rows="3" required></textarea>
            
            <label for="questionImage">Question Image (optional):</label>
            <input type="file" id="questionImage" name="questionImage" accept="image/*">

            <label for="optionA">Option A:</label>
            <input type="text" id="optionA" name="optionA" required>
            
            <label for="optionB">Option B:</label>
            <input type="text" id="optionB" name="optionB" required>
            
            <label for="optionC">Option C:</label>
            <input type="text" id="optionC" name="optionC" required>
            
            <label for="optionD">Option D:</label>
            <input type="text" id="optionD" name="optionD" required>
            
            <label for="correctAnswer">Correct Answer:</label>
            <select id="correctAnswer" name="correctAnswer">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            
            <!-- Add Question button -->
            <button type="submit">Add Question</button>
        </form>

        <!-- Go to Quiz button below the form -->
        <a href="quiz.php?book_id=<?php echo $bookId; ?>" class="go-to-quiz-button">Go to Quiz</a>
    </div>
</div>
</body>
</html>
