<?php

class Register{
    
    private $_db;
    
    public function __construct($db) {
       $this->_db=$db;
    }
    
    public function create_client($nom,$prenom,$pseudo,$mdp,$email){
        $retour=array();
        try{
            $query="SELECT create_client(:nom,:prenom,:pseudo,:mdp,:email) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':nom',$nom);
            $sql->bindValue(':prenom',$prenom);
            $sql->bindValue(':pseudo',$pseudo);
            $sql->bindValue(':mdp',$mdp);
            $sql->bindValue(':email',$email);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
}
