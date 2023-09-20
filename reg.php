<?php
include('code/Entity/User.php');
session_start();
if (isset($_GET['reg'])) {
    if ($_POST['password'] === $_POST['passwordwie']) {
        if (!User::findByName($_POST['username'])) {
            $user = User::newUser($_POST['username'], $_POST['password']);
            $_SESSION['userid'] = $user->getId();
            $error = null;
            header('Location: http://localhost:63342/quiz/index.php');
            die();
        }
        else {
            $error= '<p>Username vergeben</p>';
        }
    } else {
        $error = '<p>PW falsch</p>';
    }
}
?>


<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="?reg=1" method="post">
    Username <br>
    <input type="text" name="username">
    <br>
    passwort <br>
    <input type="password" name="password">
    <br>
    passwort wiederholen <br>
    <input type="password" name="passwordwie">
    <br>
    <?php if (isset($error)) {
        echo $error;
    } ?>
    <input type="submit">
</form>
</body>
</html>
