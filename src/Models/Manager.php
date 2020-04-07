<?php
namespace BugApp\Models;

use  BugApp\Models\Identifiant;
class Manager {
    private $bdd;
    
    function __construct() {
        $this->connectDb();
    }

    public function connectDb(){
        $id = new Identifiant();
        $dbname = $id->getDbname();
        $user = $id->getUser();
        $pwd = $id->getPwd();
        try {
            $pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
            $this->bdd = new \PDO("mysql:host=localhost;dbname=$dbname", "$user","$pwd",$pdo_options);
        } catch (PDOException $e) { 
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    public function getBdd() {
        return $this->bdd;
    }
    
    public function setBdd($bdd) {
        $this->bdd = $bdd;
    }
}
