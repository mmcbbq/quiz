<?php 
session_start(); 
$game_over_schalter = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
            body {
                background-color: #708090;
            }
        </style>
    <title>Farben Mischen</title>
</head>
<body>       
    <table border="10px">
            <tr>
                <th colspan="3"><h1 style="color: #3cb371;">Mische deine Farben</h1></th>
            </tr>
            <tr> 
              <td colspan="2">
                <img src="bilder/farben/tuerkis.jpg" alt="Dieses Bild ist einfach nur tuerkis" width="300px">
              </td>
            </tr>  
            <tr>
                <td colspan="3" align="center"> 
                <?php 
                    if (isset($_SESSION["nutzerHinweis"])){    
                    echo "Nutzerhinweis: " . $_SESSION["nutzerHinweis"] . " | "; 
                        if (isset($_SESSION["verbleibendeVersuche"])) {
                            echo "verbleibende Versuche: " . $_SESSION["verbleibendeVersuche"];                        }
                        if (isset($_SESSION["spielBeendet"])) {
                            $game_over_schalter = $_SESSION["spielBeendet"];
                        }
                    }
                ?>
                </td>
            </tr>
            <form action="code/farbenMischenAntwort.php" method="post"> 
            <tr>
                <td align="right">
                    <input type="checkbox" name="checkboxRot" value="rot" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td>
                    <p>Rot</p>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="checkbox" name="checkboxGruen" value="gruen" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td colspan="2">
                    <p>Gr&uuml;n</p>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="checkbox" name="checkboxBlau" value="blau" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td>
                    <p>Blau</p>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="neustarten" value="Neustarten">
                </td>
                <td align="center">
                    <input type="submit" name="farbmischenAbsenden" value="Farbauswahl Bestätigen" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
            </tr>
            </form>
        </table>
</body>
</html>