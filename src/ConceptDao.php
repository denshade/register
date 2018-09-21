<?php
/**
 * Created by PhpStorm.
 * User: lieven
 * Date: 21/09/2018
 * Time: 21:20
 */

class ConceptDao
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
     * @return string[] the names of the concepts.
     */
    public function getConcepts()
    {
        $conceptNames = [];
        $pdoStatement = $this->pdo->prepare('SELECT table_name FROM information_schema.tables where table_schema=\'register\'');
        $pdoStatement->execute();
        $tables = $pdoStatement->fetchAll();
        foreach($tables as $key => $table)
        {
            $conceptNames[]= $table["table_name"];
        }
        return $conceptNames;
    }

    /**
     * @param string $concept
     * @return string[]
     */
    public function getAttributes($concept)
    {
        $columns = [];
        $pdoStatement = $this->pdo->prepare('SELECT COLUMN_NAME FROM information_schema. columns WHERE table_schema=\'register\' AND table_name=\''.$concept.'\'' );
        $pdoStatement->execute();
        $tables = $pdoStatement->fetchAll();
        foreach($tables as $key => $table)
        {
            $columns[]= $table["COLUMN_NAME"];
        }
        return $columns;

    }

    public function getDataForConcept($concept)
    {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM '.$concept );
        $pdoStatement->execute();
        $data = $pdoStatement->fetchAll();
        return $data;
    }
}