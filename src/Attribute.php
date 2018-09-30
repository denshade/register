<?php
/**
 * Created by PhpStorm.
 * User: Lieven
 * Date: 23-9-2018
 * Time: 20:26
 */

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
}