<?php
// Define quiz questions and answers
$questions = [
    "One of the option contribute to motion?" => [
        "options" => ["(a)Newton", "(b) Archimedies", "(c)Neto", "(d)Aristoto"],
        "answer" => "(a)Newton"
    ],
    "D from MR NIGER D stands for?" => [
        "options" => ["(a)Growth", "(b)Dealth", "(c)Deal", " (d)Dietects"],
        "answer" => "(b)Dealth"
    ],
    "What is 2 + 2?" => [
        "options" => ["(a)3", "(b)4", "(c)5", "(d)6"],
        "answer" => "(b)4"
    ]
];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = 0;
    $i = 0;
    foreach ($questions as $question => $data) {
        if (isset($_POST["q$i"]) && $_POST["q$i"] === $data["answer"]) {
            $score++;
        }
        $i++;
    }

    echo "<h2>Your Score: $score / " . count($questions) . "</h2>";
    echo "<a href='quiz.php'>Try Again</a>";
    exit;
}
?>

<form method="post">
    <?php
    $i = 0;
    foreach ($questions as $question => $data) {
        echo "<fieldset>";
        echo "<legend>$question</legend>";
        foreach ($data["options"] as $option) {
            echo "<label>";
            echo "<input type='radio' name='q$i' value='$option' required> $option";
            echo "</label><br>";
        }
        echo "</fieldset><br>";
        $i++;
    }
    ?>
    <input type="submit" value="Submit">
</form>
