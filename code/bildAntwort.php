<?php
require('Entity/Question.php');
$cookie_name_nutzerHinweis = "Hinweis";
$cookie_name_verbleibende_Versuche = "verbleibendeVersuche";
$frage = Question::findById($_GET['frageid']);
setcookie('frageid', $frage->getId(), 0, '/');
// An hier startet die Auswertung des "NEUSTARTEN"-Buttons
if (isset($_GET["neustarten"])) {
    // Cookie für die verbleibenden Versuche wird gelöscht
    setcookie($cookie_name_verbleibende_Versuche, "", 1, "/");
    setcookie($cookie_name_nutzerHinweis, "", 1, "/");
    setcookie('frageid', false, 0, '/');
    header("Refresh:0; url=../index.php");
    // Ab hier startet die Auswertung des "Absenden"-Buttons
} elseif (!isset($_GET["AntwortGruppe"])) {
    // Dieser Block wird aktiviert, wenn der Nutzer keine Eingabe getätigt hat
    // -> Radio-Buttons sind nicht ausgewählt
    $nutzerHinweis = "<h1>Lieber Nutzer - Bitte treffe eine Auswahl!<h1>";
    //Cookies setzen
    setcookie($cookie_name_nutzerHinweis, $nutzerHinweis, time() + 3600, "/");
    // Wenn richtig , wieder zurück zur Spiel-Hauptseite
    header("Refresh:0; url=../index.php");
} else {
    // Dieser Block wird aktiviert, wenn der Nutzer eine Auswahl getroffen hat
    // -> ein Radio-Button wurde ausgewählt
//        $richtigeAntwort = "richtig";
//        $falsscheAntwort = "falsch";
//        $nutzerAntwort = $_GET["AntwortGruppe"];
    //kontrollstruktur für richtige oder falsche antworten
    if ($frage->checkAnswer($_GET['AntwortGruppe'])) {
        // Dieser Code-Block wird aktiviert,
        //wenn der Nutzer die richtige Antwort ausgewählt hat
        $nutzerHinweis = "<h1 style='color:green'>RICHTIG - GUT GEMACHT !</h1>";
        //Cookies setzen
        setcookie($cookie_name_nutzerHinweis, $nutzerHinweis, time() + 3600, "/");
        // Cookie für die verbleibenden Versuche wird gelöscht
        setcookie($cookie_name_verbleibende_Versuche, "", 1, "/");
        setcookie('frageid', false, 0, '/');
        // Wenn richtig , wieder zurück zur Spiel-Hauptseite
        header("Refresh:0; url=../index.php");
    } else {
        // Dieser Code-Block wird aktiviert, wenn eine Falsche Auswahl getätigt wurde
        $nutzerHinweis = "<h1>Deine Antwort ist FALSCH, bitte versuche erneut</h1>";
        // Cookie erzeugen
        // inkl. Cookie-Namen, Cookie-Wert, Cookie-Ablaufdatum
        $maxVersuche = 3;
        // Kontrollstruktur wird verwendet, um den Cookie-Value zu ermitteln
        // des Cookie's für verbleibende Versuche
        if (!isset($_COOKIE[$cookie_name_verbleibende_Versuche])) {
            $cookie_value_verbleibende_Versuche = $maxVersuche - 1;
        } else {
            $cookie_value_verbleibende_Versuche = $_COOKIE[$cookie_name_verbleibende_Versuche] - 1;
        }
        //Cookies setzen
        setcookie($cookie_name_nutzerHinweis, $nutzerHinweis, time() + 3600, "/");
        setcookie($cookie_name_verbleibende_Versuche, $cookie_value_verbleibende_Versuche, time() + 3600, "/");
        // Wenn alle Code-Zeilen interpretiert wurden
        // gehe auf die Spiel-Startseite zurück
        header("Refresh:0; url=../index.php");
    }
}
?>