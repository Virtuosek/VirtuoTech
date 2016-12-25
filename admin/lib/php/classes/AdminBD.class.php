<?php

class AdminBD{
    
    private $_db;
    
    public function __construct($db) {
       $this->_db=$db;
    }
    
    public function isAuthorized($login,$password){
        $retour=array();
        try{
            $query="SELECT verifier_connexion(:login,:password) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':login',$login);
            $sql->bindValue(':password',$password);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
}
