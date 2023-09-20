<?php

class User
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

    public static function findAll()
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $sql = "SELECT * FROM user";
        $results = $conn->query($sql);
        $array = $results->fetch_all(1);
        return $array;
    }

    public static function findById($id)
    {
        //Verbindung zur Datenbank
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        //Erstellen des SQL Befehls -> string
        $sql = "Select * from user where id = ".$id;
        //Ausführen des SQL Befehls -> mysqli_result
        $results = $conn->query($sql);
        //rufen wir die Methode des mysqli_result Objects aus -> array
        $array = $results->fetch_assoc();
        //Erstellen des Usernew Objects mit den Daten aus der DB -> Usernew Object
        $userObj = new User($array['id'],$array['username'],$array['password']);
        //rückgabe des Usernew Object
        return $userObj;

    }

    public static function findByName($name) :User|bool
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$name);
        $stmt->execute();
        $mysqliresult = $stmt->get_result();
        $array = $mysqliresult->fetch_assoc();
        if ($array){
        $user = new User($array ['id'],$array['username'],$array['password']);
        return $user;}
        else
            return false;

    }

    public static function newUser(string $username, string $password):User
    {
        $conn = new mysqli("localhost", "root", "", "spielemitfarben");
        $hashpassword= password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password) values (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss',$username, $hashpassword);
        $stmt->execute();
        return User::findById($conn->insert_id);
    }
    public function checkPassword($password) :bool
    {
       return (password_verify($password,$this->password));
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


