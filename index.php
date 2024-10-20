<?php
// Load questions from JSON file
$questions = json_decode(file_get_contents('questions.json'), true);
echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo '<h1 class="title">Wrack Your Brain 🧠🧠</h1>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;

    foreach ($questions as $index => $question) {
        $userAnswer = $_POST["question_$index"] ?? null;
        if ($userAnswer === $question['answer']) {
            $score++;
        }
    }
    echo '<div class="result-container">';
    echo "<h1>Your score: $score/" . 10 . "</h1>";
    if ($score == 10) {
        echo '<h1>Don\'t use chatgpt too much. 😑😑</h1>';
        echo '<img src="https://media1.tenor.com/m/0wj4ApfUlWUAAAAd/whatever-bank-stare.gif" alt="A fun GIF" width="300">';
    } else if ($score > 6) {
        echo '<h1>Luck can only get you so far. 😮‍💨😮‍💨</h1>';
        echo '<img src="https://media1.tenor.com/m/0wj4ApfUlWUAAAAd/whatever-bank-stare.gif" alt="A fun GIF" width="300">';
    } else if ($score > 3) {
        echo '<h1>You suck at this, seek help!</h1>';
        echo '<img src="https://media1.tenor.com/m/aOPE7_CUaucAAAAC/stop-it-get-some.gif" alt="A fun GIF" width="500">';
    } else {
        echo '<h1>Even an elementary school kid can do better than this</h1>';
        echo '<img src="https://media1.tenor.com/m/aOPE7_CUaucAAAAC/stop-it-get-some.gif" alt="A fun GIF" width="500">';
    }
    echo '<a href="index.php" class="btn-submit">Try Again</a>';
    echo '</div>';
} else {
    // Shuffle and select a few random questions
    $randomQuestions = array_rand($questions, 10); // Change the number as needed
    echo '<form method="POST">';
    foreach ($randomQuestions as $index) {
        echo "<div class='question-card'>";
        echo "<h2>{$questions[$index]['question']}</h2>";
        foreach ($questions[$index]['options'] as $option) {
            echo "<label><input type='radio' name='question_$index' value='$option'> $option</label><br>";
        }
        echo "</div>";
    }
    echo '<button type="submit" class="btn-submit">Submit</button>';
    echo '</form>';
}
?>
