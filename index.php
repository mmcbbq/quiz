<?php
    // Cookie - verbleibende Versuche auslesen
    $cookie_name_verbleibende_Versuche = "verbleibendeVersuche";
    $cookie_name_nutzerHinweis = "Hinweis";
    $game_over_schalter = 0;
    $nutzerHinweis = null;


    $conn = new mysqli("localhost", "root", "", "spielemitfarben");

    $sql = "SELECT * FROM user";
    $results =$conn->query($sql);



//    var_dump($results->fetch_all());
foreach ($results as $row){
    echo("<p>". $row['username']."</p>");
}





//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//echo "Connected successfully";



    // Cookie - Nutzerhinweis auslesen
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
<html>
    <head>
        <title>Hello World</title>
        <style>
            body {
                background-color: #708090;
            }
        </style>
    </head>
    <body>
        
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
                            <?php echo $nutzerHinweis;?>
                </td>
            </tr>
            <form action="code/bildAntwort.php" method="get"> 
            <tr>
                <td align="right">
                    <input type="radio" name="AntwortGruppe" value="falsch" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td colspan="2">
                    <p>Antwort 1</p>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="radio" name="AntwortGruppe" value="falsch" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td colspan="2">
                    <p>Antwort 2</p>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <input type="radio" name="AntwortGruppe" value="richtig" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
                <td colspan="2">
                    <p>Antwort 3</p>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="neustarten" value="Neustarten">
                </td>
                <td colspan="2" align="center">
                    <input type="submit" name="antwortAbsenden" value="ANTWORTEN" <?php if($game_over_schalter == 1){echo "disabled";}?>>
                </td>
            </tr>
            </form>
        </table>
    </body>
</html>


                    