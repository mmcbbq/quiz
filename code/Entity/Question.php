<?php

class Question
{
    private int $id;
    private string $question;
    private string $answer_a;
    private string $answer_b;
    private string $answer_c;

    /**
     * @param int $id
     * @param string $question
     * @param string $answer_a
     * @param string $answer_b
     * @param string $answer_c
     */
    public function __construct(int $id, string $question, string $answer_a, string $answer_b, string $answer_c)
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer_a = $answer_a;
        $this->answer_b = $answer_b;
        $this->answer_c = $answer_c;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getAnswerA(): string
    {
        return $this->answer_a;
    }

    /**
     * @param string $answer_a
     */
    public function setAnswerA(string $answer_a): void
    {
        $this->answer_a = $answer_a;
    }

    /**
     * @return string
     */
    public function getAnswerB(): string
    {
        return $this->answer_b;
    }

    /**
     * @param string $answer_b
     */
    public function setAnswerB(string $answer_b): void
    {
        $this->answer_b = $answer_b;
    }

    /**
     * @return string
     */
    public function getAnswerC(): string
    {
        return $this->answer_c;
    }

    /**
     * @param string $answer_c
     */
    public function setAnswerC(string $answer_c): void
    {
        $this->answer_c = $answer_c;
    }

    public static function findAll(): array
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $sql = "SELECT * FROM question";
        $results = $conn->query($sql);
        $array = $results->fetch_all(1);

        $obj = [];
        foreach ($array as $item) {
            $obj[]  = new Question($item['id'], $item['question'], $item['answer_a'], $item['answer_b'], $item['answer_c']);
        }
        return $obj;

    }

    public static function findById($id): Question
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $sql = "SELECT * FROM question WHERE id =".$id;
        $result =$conn->query($sql);
        $array = $result->fetch_assoc();
        $obj = new Question($array['id'], $array['question'], $array['answer_a'], $array['answer_b'], $array['answer_c']);
        return $obj;
    }

    public static function findByName($name):Question
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $sql = "SELECT * FROM question WHERE question = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$name);
        $stmt->execute();
        $mysqliresult= $stmt->get_result();
        $array = $mysqliresult->fetch_assoc();
        $obj = new Question($array['id'], $array['question'], $array['answer_a'], $array['answer_b'], $array['answer_c']);
        return $obj;

    }

    public function checkAnswer($userAnswer):bool
    {if ( $this->getAnswerC() == $userAnswer){
        return true;
    }
    return false;
    }

    public function randomAnswerArray():array
    {
        $array=[];
        array_push($array, $this->getAnswerA(),$this->getAnswerB(),$this->getAnswerC());
         shuffle($array);
        return $array;

    }




}

