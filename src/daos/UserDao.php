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
        $pdoStatement = $this->pdo->prepare("SELECT User FROM mysql.db where Db = '".getDatabaseName()."'");
        $pdoStatement->execute();
        $users = $pdoStatement->fetchAll();
        foreach ($users as $key => $username) {
            $usernames [] = $username["User"];
        }
        return $usernames;

    }

    //GRANT ALL PRIVILEGES ON database.* TO 'user'@'localhost'
    public function createUser($username, $password, $grantCreate, $grantDrop, $grantDelete, $grantInsert, $grantUpdate, $grantGrant)
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
        $withGrant = "";
        if ($grantGrant) {
            $withGrant .= " WITH GRANT OPTION";
        }

        $pdoStatement = $this->pdo->prepare("GRANT $privileges ON ".getDatabaseName().".* TO '$username'@'".getDatabaseHost()."' IDENTIFIED BY '$password' $withGrant");
        $success = $pdoStatement->execute();
        if ($grantGrant)
        {
            $pdoStatement = $this->pdo->prepare("GRANT SELECT ON mysql.db TO '$username'@'".getDatabaseHost()."'");
            $pdoStatement->execute();

            $pdoStatement = $this->pdo->prepare("GRANT GRANT OPTION, CREATE USER ON *.* TO '$username'@'".getDatabaseHost()."'");
            $pdoStatement->execute();
        }
        return $success;
    }

    public function deleteUser($username)
    {
        $pdoStatement = $this->pdo->prepare("DROP USER '$username'@'".getDatabaseHost()."'");
        $pdoStatement->execute();
    }
}