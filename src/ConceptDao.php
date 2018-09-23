<?php

require_once "Attribute.php";

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
    public function getAttributesNames($concept)
    {
        $columns = [];
        $pdoStatement = $this->pdo->prepare('SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema=\'register\' AND table_name=\''.$concept.'\'' );
        $pdoStatement->execute();
        $tables = $pdoStatement->fetchAll();
        foreach($tables as $key => $table)
        {
            $columns[]= $table["COLUMN_NAME"];
        }
        return $columns;

    }

    /**
     * @param string $concept
     * @return Attribute[]
     */
    public function getAttributes($concept)
    {
        $attributes = [];
        $pdoStatement = $this->pdo->prepare('SELECT * FROM information_schema.columns WHERE table_schema=\'register\' AND table_name=\''.$concept.'\'' );
        $pdoStatement->execute();
        $tables = $pdoStatement->fetchAll();
        foreach($tables as $key => $table)
        {
            $attribute = new Attribute();
            $attribute->name = $table["COLUMN_NAME"];
            $attribute->type = $table["COLUMN_TYPE"];
            $attributes[]= $attribute;
        }
        return $attributes;

    }

    public function getDataForConcept($concept)
    {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM '.$concept );
        $pdoStatement->execute();
        $data = $pdoStatement->fetchAll();
        return $data;
    }

    public function addTableColumn($tablename, $columnName, $type)
    {
        $pdoStatement = $this->pdo->prepare("ALTER TABLE $tablename ADD COLUMN $columnName $type");
        $pdoStatement->execute();

    }
}