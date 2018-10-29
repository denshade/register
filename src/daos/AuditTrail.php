<?php

class AuditTrail
{

    public static function getAuditFile()
    {
            return dirname(__FILE__)."/../../audit.csv";
    }
    public static function audit($username, $action)
    {
        if (file_put_contents(self::getAuditFile(), date("c").',"'.$username.'","'.$action.'"'.PHP_EOL, FILE_APPEND) === FALSE)
            throw new Exception("Unable to write to audit trail " .self::getAuditFile());
    }
}