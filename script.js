// Initialize current question index
let currentQuestionIndex = 0;

// Display the first question initially
displayQuestion(currentQuestionIndex);

// Function to display the question
function displayQuestion(index) {
    const totalQuestions = document.querySelectorAll('.question-block').length;
    
    // Hide all questions and only display the current one
    for (let i = 0; i < totalQuestions; i++) {
        document.getElementById(`question-${i + 1}`).style.display = 'none';
    }
    
    // Show the current question block
    document.getElementById(`question-${index + 1}`).style.display = 'block';
}


function checkAnswer(selectedOption, questionIndex) {
    const question = questions[currentQuestionIndex];
    const correctAnswer = question.correct_answer;

    if (selectedOption === correctAnswer) {
        // Show the unique success GIF for the current question
        const successGif = document.getElementById(`successGif-${questionIndex}`);
        successGif.style.display = "block";

        // Play success sound
        const successSound = new Audio('success.mp3'); // Adjust path if needed
        successSound.play();

        // Move to the next question after 2 seconds
        setTimeout(() => {
            successGif.style.display = "none"; // Hide the GIF
            currentQuestionIndex++;

            if (currentQuestionIndex < questions.length) {
                displayQuestion(currentQuestionIndex); // Display the next question
            } else {
                bootbox.alert("Je hebt de quiz voltooid!"); // Quiz completion message
            }
        }, 2000);
    } else {
        bootbox.alert("Onjuist antwoord, probeer het opnieuw.");// Incorrect answer feedback
    }
 // Show spinner on page load
window.addEventListener("load", function() {
    document.getElementById("loadingSpinner").style.display = "none";
});

// Show the loading spinner on page transitions
function showLoading() {
    document.getElementById("loadingSpinner").classList.add("loading");
}

// Apply the loading effect to all navigation links
document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", function() {
        showLoading();
    });
});
   
}