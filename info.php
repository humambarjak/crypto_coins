<?php
session_start();
// include('navbar.php'); // Navbar inclusion at the top
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Page</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your main CSS file -->
</head>
<!-- Navbar and Header -->
<div id="navbar">
    <?php include('navbar.php'); ?>
</div>

<!-- Dynamic Content Area -->
<div id="content">
    <!-- Initial content goes here or via AJAX -->
</div>

<body>
<div id="loadingSpinner" class="spinner-container">
    <div class="spinner"></div>
</div>
    <div class="info-container">
        <h1>Hoe de website te gebruiken</h1>
        
        <section>
            <h2>Over de website</h2>
            <p>Dit platform is ontworpen om studenten op een leuke en interactieve manier te helpen leren door quizzen te spelen over verschillende boeken die door hun docenten zijn toegewezen.</p>
        </section>
        
        <section>
            <h2>Hoe krijg je toegang tot quizzen?</h2>
            <p>Zodra je bent ingelogd als student, kun je een lijst met beschikbare boeken bekijken. Klik op de boekomslag om toegang te krijgen tot de bijbehorende quiz.</p>
        </section>
        
        <section>
            <h2>Hoe de quiz te spelen</h2>
            <p>Elke quiz bestaat uit meerdere vragen over het geselecteerde boek. Kies voor elke vraag het juiste antwoord uit de gegeven opties. Je krijgt direct feedback op elk antwoord.</p>
        </section>
        
        <section>
            <h2>Voltooiing en score</h2>
            <p>Na het voltooien van de quiz krijg je een bericht dat je klaar bent. Je kunt quizzen opnieuw bekijken zoals toegewezen door je docent.</p>
        </section>

        <button onclick="window.location.href='student_dashboard.php';" class="back-button">Terug naar Dashboard</button>
    </div>
    <script src="script.js"></script> <!-- Link to the external JavaScript file -->
</body>
</html>
