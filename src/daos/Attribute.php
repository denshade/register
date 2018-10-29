<?php

class Attribute
{
    public $type;
    public $name;

    public function isEnum()
    {
        return strpos($this->type, "enum(") !== FALSE;
    }

    public function isInt()
    {
        return strpos($this->type, "int") !== FALSE;
    }

    public function isBoolean()
    {
        return strpos($this->type, "tinyint") !== FALSE;
    }

    public function isVarchar()
    {
        return strpos($this->type, "varchar") !== FALSE;
    }
    public function isText()
    {
        return strpos($this->type, "text") !== FALSE;
    }

    public function isDouble()
    {
        return strpos($this->type, "double") !== FALSE;
    }

    public function isDate()
    {
        return $this->type == "date";
    }

    public function isDateTime()
    {
        return $this->type == "datetime";
    }


    /**
     *
     */
    public function getOptions()
    {
        if (!$this->isEnum()) throw new Exception("Getting options for non enum type");
        $options = [];
        $optionsFirst = substr($this->type, strlen("enum("));
        $optionsFirst = substr($optionsFirst, 0, strlen($optionsFirst) - 1);
        foreach (explode(",", $optionsFirst) as $option) {
            $option = substr($option, 1, strlen($option) - 2);
            $options[]= $option;
        }
        return $options;
    }
}