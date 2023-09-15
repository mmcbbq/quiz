<?php

class Usernew
{
    private int $id;

    private string $username;

    private string $password;

    /**
     * @param int $id
     * @param string $username
     * @param string $password
     */
    public function __construct(int $id, string $username, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    public static function sqlQuery(string $sql){
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $results = $conn->query($sql);

        return $results->fetch_all(1);
    }
    public static function findAll():array
    {
        $sql = "SELECT * FROM user";
//        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
//        $sql = "SELECT * FROM user";
//        $results = $conn->query($sql);
//        $array = $results->fetch_all(1);
        $userarray = [];
        foreach (Usernew::sqlQuery($sql) as $user){
            $userarray[]= new Usernew($user['id'],$user['username'],$user['password']);
        }

        return $userarray;
    }

    public static function findById($id)
    {
//        //Verbindung zur Datenbank
//        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
//        //Erstellen des SQL Befehls -> string
        $sql = "Select * from user where id = ".$id;
//        //Ausführen des SQL Befehls -> mysqli_result
//        $results = $conn->query($sql);
//        //rufen wir die Methode des mysqli_result Objects aus -> array
//        $resultarray = $results->fetch_all(1);
        $array = Usernew::sqlQuery($sql)[0];
        //Erstellen des Usernew Objects mit den Daten aus der DB -> Usernew Object
        $userObj = new Usernew($array['id'],$array['username'],$array['password']);
        //rückgabe des Usernew Object
        return $userObj;
    }
    public static function findByName(string $name){
        $sql = "SELECT * FROM user WHERE username ='" .$name."'";
        $array = Usernew::sqlQuery($sql)[0];
        $userObj = new Usernew($array['id'],$array['username'],$array['password']);
        return $userObj;
    }


    public function sagHallo()
    {
        echo('Hallo mein Name ist '.$this->username);
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}

//$user = Usernew::findByname('manuel');
//echo ($user->getUsername());

$array[]='apfel';
var_dump($array);
function test( &$array){
    $array[]='birne';
    echo '<br>';
    var_dump($array);

}
test($array);
echo '<br>';
var_dump($array);
//foreach (Usernew::findAll() as $user){
//    echo ('<div>'.$user->getUsername().'</div>');
//}
//$newUser = Usernew::findById(1);
//echo($newUser->getUsername());
//$manuel->id = 1;
//$manuel->username= "Manuel";
//$manuel->password= "123";
//echo($manuel->username);
//$manuel->sagHallo();
//echo(Usernew::findById(1)->sagHallo());

//foreach ($manuel->findAll() as $row){
//    echo('<div> Name: '.$row['username'].'</div>');
//
//}


//var_dump($manuel->DBconn());