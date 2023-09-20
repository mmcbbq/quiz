<?php
require('code/Entity/Question.php');
require ('code/Entity/User.php');
session_start();
if (!isset($_SESSION['userid'])){
    header('Location: http://localhost:63342/quiz/login.php');
};
$cookie_name_verbleibende_Versuche = "verbleibendeVersuche";
$cookie_name_nutzerHinweis = "Hinweis";
$game_over_schalter = 0;
$nutzerHinweis = null;
//var_dump($_SESSION);
if (!isset($_COOKIE['frageid'])) {
    $fragen = Question::findAll();
    $index = array_rand($fragen);
    $frage = $fragen[$index];
    if (get_class($frage) === Question::class)
        $antworten = $frage->randomAnswerArray();
    setcookie('antworten', json_encode($antworten), 0, '/');
} else {
    $frage = Question::findById($_COOKIE['frageid']);
    $antworten = json_decode($_COOKIE['antworten']);
}

if (isset($_COOKIE[$cookie_name_nutzerHinweis])) {
    $nutzerHinweis = $_COOKIE[$cookie_name_nutzerHinweis];
} else {
    $nutzerHinweis = "<h1 style='color:green'>Los Gehts</h1>";
}

if (isset($_COOKIE[$cookie_name_verbleibende_Versuche])) {

    $verbleibendeVersuche = $_COOKIE[$cookie_name_verbleibende_Versuche];

    if ($verbleibendeVersuche <= 0) {
        $nutzerHinweis = "<h1 style='color:red'>GAME OVER</h1>";
        $game_over_schalter = 1;
    }

} else {
    $verbleibendeVersuche = 3;
}
?>
<html lang="de">
<head>
    <title>Hello World</title>
    <style>
        body {
            background-color: #708090;
        }
    </style>
</head>
<body>
<h1>Hallo <?php echo User::findById($_SESSION['userid'])->getUsername().'Du hast noch'.$verbleibendeVersuche ?></h1>
<table border="10px">
    <tr>
        <th colspan="3"><h1 style="color: #3cb371;">Mein erstes Bild</h1></th>
    </tr>
    <tr>
        <td>
            <img src="bilder/bild.jpg" alt="Bildbeschreibung" width="300px">
        </td>
        <td>
            <img src="bilder/bild.jpg" alt="Bildbeschreibung" width="300px">
        </td>
        <td>
            <img src="bilder/bild.jpg" alt="Bildbeschreibung" width="300px">
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            <?php echo $nutzerHinweis;

            ?>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center">
            <?php echo $frage->getQuestion();
            if ($game_over_schalter == 1) {

                echo('<p>Die Richtige Antwort war ' . $frage->getAnswerC() . '</p>');
            } ?>
        </td>
    </tr>
    <form action="code/bildAntwort.php" method="get">
        <input type="text" name="frageid" value="<?php echo $frage->getId(); ?>" hidden readonly>
        <?php

        if ($game_over_schalter == 1) {
        } else {
            foreach ($antworten as $antwort) {
                echo('  
            <tr>
            <td align="right">
                <input type="radio" name="AntwortGruppe"
                       value="' . $antwort . '">
        </td>
        <td colspan="2">
            <p> ' . $antwort . '</p>
        </td>
        </tr>
           ');
            }
        } ?>
        <tr>
            <td align="center">
                <input type="submit" name="neustarten" value="Neustarten">
            </td>
            <td colspan="2" align="center">
                <input type="submit" name="antwortAbsenden" value="ANTWORTEN" <?php if ($game_over_schalter == 1) {
                    echo "disabled";
                } ?>>
            </td>
        </tr>
    </form>
</table>
</body>
</html>


                    