<?php
include('db.php'); // Database connection
// include('navbar.php'); // Navbar inclusion at the top

// Get the book_id from the URL, and check if it exists
if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Fetch book details, including the PDF path
    $bookQuery = $conn->prepare("SELECT title, pdf_path FROM books WHERE id = ?");
    $bookQuery->bind_param("i", $bookId);
    $bookQuery->execute();
    $book = $bookQuery->get_result()->fetch_assoc();

    if (!$book) {
        die("Book not found.");
    }
} else {
    die("Error: No book selected. Please go back and choose a book.");
}

// Fetch the questions for the selected book from the database
$query = $conn->prepare("SELECT * FROM questions WHERE book_id = ?");
$query->bind_param("i", $bookId);
$query->execute();
$questions = $query->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- jQuery Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootbox.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <title>Boeken Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar and Header -->
<div id="navbar">
    <?php include('navbar.php'); ?>
</div>

<!-- Dynamic Content Area -->
<div id="content">
    <!-- Initial content goes here or via AJAX -->
</div>

<div id="loadingSpinner" class="spinner-container">
    <div class="spinner"></div>
</div>
<div class="quiz-container">
    <h1>Boeken Quiz</h1>

    <!-- Flex container for PDF and Questions -->
    <div class="content-wrapper">
        <!-- PDF viewer on the left -->
        <?php if (!empty($book['pdf_path'])): ?>
            <div class="pdf-viewer">
                <iframe src="<?php echo htmlspecialchars($book['pdf_path']); ?>" width="100%" height="600px"></iframe>
            </div>
        <?php else: ?>
            <p>Er is geen PDF beschikbaar voor dit boek.</p>
        <?php endif; ?>

        <div class="question-section">
    <?php foreach ($questions as $index => $question): ?>
        <div class="question-block" id="question-<?php echo $index + 1; ?>" style="<?php echo $index === 0 ? '' : 'display: none;' ?>">
            <h2>Vraag <?php echo $index + 1; ?>: <?php echo htmlspecialchars($question['question']); ?></h2>

            <?php if (!empty($question['image_path'])): ?>
                <img src="<?php echo htmlspecialchars($question['image_path']); ?>" alt="Question Image" class="quiz-image">
            <?php endif; ?>

            <div class="options">
    <button class="option-label option-red" onclick="checkAnswer('A', <?php echo $index + 1; ?>)">
        <?php echo htmlspecialchars($question['option_a']); ?>
    </button>
    <button class="option-label option-blue" onclick="checkAnswer('B', <?php echo $index + 1; ?>)">
        <?php echo htmlspecialchars($question['option_b']); ?>
    </button>
    <button class="option-label option-yellow" onclick="checkAnswer('C', <?php echo $index + 1; ?>)">
        <?php echo htmlspecialchars($question['option_c']); ?>
    </button>
    <button class="option-label option-green" onclick="checkAnswer('D', <?php echo $index + 1; ?>)">
        <?php echo htmlspecialchars($question['option_d']); ?>
    </button>
</div>

            

            <!-- Unique Success GIF for each question -->
            <img id="successGif-<?php echo $index + 1; ?>" src="successGif.gif" class="success-gif" style="display: none; width: 100px; height: auto; margin-top: 20px;" alt="Success GIF">
        </div>
    <?php endforeach; ?>
</div>



<script src="script.js"></script> <!-- Link to the external JavaScript file -->
<script>
    // Initialize the questions array in JavaScript with PHP data
    const questions = <?php echo json_encode($questions); ?>;
</script>

</body>
</html>
