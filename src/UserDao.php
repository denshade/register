<?php

require_once "Attribute.php";

class UserDao
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return string[]
     */
    public function getUsers()
    {
        $usernames = [];
        $pdoStatement = $this->pdo->prepare('SELECT User FROM mysql.user');
        $pdoStatement->execute();
        $users = $pdoStatement->fetchAll();
        foreach ($users as $key => $username) {
            $usernames [] = $username["User"];
        }
        return $usernames;

    }

    //GRANT ALL PRIVILEGES ON database.* TO 'user'@'localhost'
    public function createUser($username, $password, $grantCreate, $grantDrop, $grantDelete, $grantInsert, $grantUpdate)
    {
        $privileges = "SELECT";
        if ($grantCreate){
            $privileges .= ", CREATE";
        }
        if ($grantDrop){
            $privileges .= ", DROP";
        }
        if ($grantDrop){
            $privileges .= ", DROP";
        }
        if ($grantDelete){
            $privileges .= ", DELETE";
        }
        if ($grantInsert){
            $privileges .= ", INSERT";
        }
        if ($grantUpdate){
            $privileges .= ", UPDATE";
        }

        $pdoStatement = $this->pdo->prepare("GRANT $privileges ON ".getDatabaseName().".* TO '$username'@'".getDatabaseHost()."' IDENTIFIED BY '$password'");
        $success = $pdoStatement->execute();
        if (!$success) {
            var_dump($pdoStatement->errorInfo());
        }
        return $success;

    }

    public function deleteUser($username)
    {
        //DROP USER 'user'@'localhost'
    }
}