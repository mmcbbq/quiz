<?php
session_start();

$nutzerAntwort = null;
$richtigeAntwort = null;

$maxVersuche = 3;
$verbleibendenVersuche = null;

if(isset($_POST["neustarten"])){
    session_unset();
    header("Refresh:0; url=../farbenMischen.php");
}elseif(isset($_POST["farbmischenAbsenden"])){

// Stufe 1 - Überprüfe, ob überhuapt eine Auswahl getätigt wurde!
if (!isset($_POST["checkboxRot"]) && !isset($_POST["checkboxGruen"]) && !isset($_POST["checkboxBlau"])) {
    $_SESSION["nutzerHinweis"] = "Keine Farbauswahl getätigt";
    $_SESSION["verbleibendeVersuche"] = $maxVersuche;
    header("Refresh:0; url=../farbenMischen.php");
// Stufe 2              - Überprüfe, ob 2 Farben (Farb-Checkboxen) gwählt wurden?
}else{
 
    $zaehler = 0;

    $farbauswahlROT = null;
    $farbauswahlBLAU = null;
    $farbauswahlGRUEN = null;

    foreach($_POST as $array_key => $array_value) {
      if($array_key == "checkboxGruen"){
          $zaehler = $zaehler + 1;
          $farbauswahlGRUEN = $_POST["checkboxGruen"];
      }
      if($array_key == "checkboxBlau"){
          $zaehler = $zaehler + 1;
          $farbauswahlBLAU = $_POST["checkboxBlau"];
      }
      if($array_key == "checkboxRot"){
          $zaehler = $zaehler + 1;
          $farbauswahlROT = $_POST["checkboxRot"];
      }
    }

    // Stufe 3  - Mögliche Farb-Kombination abprüfen
    // Mögliche Farb-Kombination: (1) rot-gruen | (2) rot-blau | (3) gruen-blau | (4) rot-gruen-blau
    if ($zaehler == "2") {
        // Lösungbetrachtung:
        // Wenn die Farb_variablen ausgewählt wurden vom Nutzer, dann sind diese auch nicht mehr NULL
        // Daraus folgt die Nutzung der isset() Funktion 
        // -> 1. Existiert die angegebene Variable | 2. Ist der Wert irgendetwas außer NULL
        if (isset($farbauswahlBLAU) && (isset($farbauswahlGRUEN))) {
            $_SESSION["nutzerHinweis"] = "Glückwunsch - Farbe ist richtig gemischt";
            $_SESSION["spielBeendet"] = 1;
            header("Refresh:0; url=../farbenMischen.php");
       }else {
            $_SESSION["nutzerHinweis"] = "Leider Falsch";

            // 1. Runde
            if (!isset($_SESSION["verbleibendeVersuche"])) {
                $_SESSION["verbleibendeVersuche"] = $maxVersuche - 1;
            // 2. Runde oder 3. Runde
            } else {
                $_SESSION["verbleibendeVersuche"] = $_SESSION["verbleibendeVersuche"] - 1;
                
                if($_SESSION["verbleibendeVersuche"] == 0){
                    $_SESSION["nutzerHinweis"] = "GAME OVER";
                    $_SESSION["spielBeendet"] = 1;
                }
            }         

        header("Refresh:0; url=../farbenMischen.php");
       }     
    }elseif ($zaehler =="3") {

        $_SESSION["nutzerHinweis"] = "Bitte nur 2 Farben wählen!";
        // 1. Runde
        if (!isset($_SESSION["verbleibendeVersuche"])) {
            $_SESSION["verbleibendeVersuche"] = $maxVersuche - 1;
        // 2. Runde oder 3. Runde
        } else {

                $_SESSION["verbleibendeVersuche"] = $_SESSION["verbleibendeVersuche"] - 1;

                if($_SESSION["verbleibendeVersuche"] == 0){
                    $_SESSION["nutzerHinweis"] = "GAME OVER";
                    $_SESSION["spielBeendet"] = 1;
                }
        } 
        header("Refresh:0; url=../farbenMischen.php");

    }else{ 

        $_SESSION["nutzerHinweis"] = "Spiel nicht verstanden - bitte 2 Farben wählen!";
        // 1. Runde
        if (!isset($_SESSION["verbleibendeVersuche"])) {
            $_SESSION["verbleibendeVersuche"] = $maxVersuche - 1;
        // 2. Runde oder 3. Runde
        } else {
            
            $_SESSION["verbleibendeVersuche"] = $_SESSION["verbleibendeVersuche"] - 1;

            if($_SESSION["verbleibendeVersuche"] == 0){
                $_SESSION["nutzerHinweis"] = "GAME OVER";
                $_SESSION["spielBeendet"] = 1;
            }
                
        } 
        header("Refresh:0; url=../farbenMischen.php");

    }
}
}
?>
