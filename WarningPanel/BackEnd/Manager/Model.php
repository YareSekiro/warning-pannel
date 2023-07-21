<?php
/**
 * Copyright (c) iFive 2020.
 * Developed by Mus (Jun#666) for iFive.
 *  U are not allowed to use / edit php file without my permission.
 */

namespace App\Manager;
use \PDO;


/**
 * Class Model
 * @package App\Manager
 */
abstract class Model
{
    /**
     * @var
     */
    private static $_bdd;
    /**
     * DATABASE CONNEXION
     */
    const DB_DBN_HOST = "mysql:dbname=averto;host=localhost";
    /**
     * DATABASE USER
     */
    const DB_USER = "root";
    /**
     * DATABASE PASS
     */
    const DB_PASS = "M^3b>49c?F5nW";

    /*
     * Connect to the database
     */
    /**
     *
     */
    private function setBdd()
    {
        try{
            self::$_bdd = new PDO(self::DB_DBN_HOST , self::DB_USER , self::DB_PASS);
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_WARNING);
            self::$_bdd->exec("SET CHARACTER SET utf8");
            self::$_bdd->exec('SET NAMES utf8');
        }catch(\Throwable $e){
            die('Erreur : ' .$e->getMessage());
        }//END OF CATCH
    }//END OF FUNCTION SETBDD

    /**
     * @return mixed
     */
    protected function getBdd()
    {
        if(self::$_bdd == null)
        {
            $this->setBdd();
        }
        return self::$_bdd;
    }//END OF GETBDD



}//END OF CLASS


?>