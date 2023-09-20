<?php
require ('code/Entity/User.php');
session_start();

if (isset($_GET['login'])){
$user = User::findByName($_POST['username']);
if($user->checkPassword($_POST['password'])){
    $_SESSION['userid']= $user->getId();
    header('Location: http://localhost:63342/quiz/index.php');
    die();


//    header();
}else{
    echo 'falsch';
}
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="?login=1" method="post">
    Username <br>
    <input type="text" name="username">
    <br>
    passwort <br>
    <input type="password" name="password">
    <br>
    <input type="submit">
</form>
</body>
</html>
