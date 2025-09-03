<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$url = explode('/',$_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];
$resource = $url[2];
$id = $url[3] ?? null;
if ($id === ''){
    $id = null;
}

$pdo = new PDO("mysql:host=localhost;dbname=quiz;charset=utf8mb4", 'root', '');
switch ($resource){
    case 'questions':

        if (isset($id)){
            $sql = 'SELECT * FROM question where id = :id';
            $stm = $pdo->prepare($sql);
            $stm->execute(['id'=>$id]);
        }else{

            $sql = 'SELECT * FROM question';
            $stm = $pdo->prepare($sql);
            $stm->execute();
        }
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$question){
            $queID = $question['id'];
            $question['answers'] = [];
            $answersql = "SELECT id From answer where question_id = $queID";
            $ansstm = $pdo->prepare($answersql);
            $ansstm->execute();
            $answers = $ansstm->fetchAll(PDO::FETCH_ASSOC);
            foreach ($answers as $answer){
                $answerid = $answer['id'];
                $question['answers'][] = "localhost/quiz/answers/$answerid";

            }
        }
        echo json_encode($result);
        break;
    case 'answers':
        if (isset($id)){
            http_response_code('404');
            $sql = 'SELECT * FROM answer where id = :id';
            $stm = $pdo->prepare($sql);
            $stm->execute(['id'=>$id]);
        }else{
            $sql = 'SELECT * FROM answer';
            $stm = $pdo->prepare($sql);
            $stm->execute();
        }
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
        break;
    case 'quiz':
        echo 'test';
        header('Content-Type: text/html');
        include 'index.html';
        break;
}
