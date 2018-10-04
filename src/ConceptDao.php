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
            if (strpos($table["table_name"], '_') === FALSE)
            {
                $conceptNames[]= $table["table_name"];
            }
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

    public function addDataForConcept($concept, $map, $sliceOffset = true)
    {
        $attributes = $this->getAttributes($concept);
        $values = [];
        $attributeNames = [];
        if ($sliceOffset)
        {
            $attributes = array_slice($attributes, 1); //slice off the autogenerated id.
        }
        foreach($attributes as $attribute)
        {
            $value = @$map[$attribute->name];
            $attributeNames []= $attribute->name;
            if ($attribute->isBoolean())
            {
                if ($value === "on") {
                    $value = 1;
                } else{
                    $value = 0;
                }

            } else if ($attribute->isInt()) {
                $value = (int)$value;
            } else if ($attribute->isEnum()) {
                $value = "'$value'";
            }else if ($attribute->isVarchar()) {
                $value = "'$value'";
            }
            $values []= $value;
        }
        $success = $this->pdo->exec("INSERT INTO $concept (".implode(",", $attributeNames).") VALUES(".implode(",", $values).")");
        if (!$success)
        {
            var_dump($this->pdo->errorInfo());
        }
        return $success;
    }

    public function createConcept($concept)
    {
        $pdoStatement = $this->pdo->prepare("CREATE TABLE $concept (id${concept} INT UNSIGNED AUTO_INCREMENT PRIMARY KEY)");
        $success = $pdoStatement->execute();
        if (!$success) {
            var_dump($pdoStatement->errorInfo());
        }
        return $success;
    }

    public function dropTable($concept)
    {
        $pdoStatement = $this->pdo->prepare("DROP TABLE $concept");
        $success = $pdoStatement->execute();
        if (!$success) {
            var_dump($pdoStatement->errorInfo());
        }
        return $success;

    }

    public function linkConcept($sourceconcept, $destinationconcept)
    {
        $pdoStatement = $this->pdo->prepare("CREATE TABLE _${sourceconcept}2${destinationconcept} (id${sourceconcept} INT, id${destinationconcept} INT)");
        $success = $pdoStatement->execute();
        if (!$success) {
            var_dump($pdoStatement->errorInfo());
        }
        return $success;
    }

    /***
     * @return array
     */
    public function getConceptLinks()
    {
        $conceptNames = [];
        $pdoStatement = $this->pdo->prepare('SELECT table_name FROM information_schema.tables where table_schema=\'register\'');
        $pdoStatement->execute();
        $tables = $pdoStatement->fetchAll();
        foreach($tables as $key => $table)
        {
            if (strpos($table["table_name"], '_') !== FALSE)
            {
                $conceptNames[]= explode('2', substr($table["table_name"],1));
            }
        }
        return $conceptNames;
    }

}