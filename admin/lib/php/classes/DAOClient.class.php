<?php

class DAOClient {
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
        
    /* Create : */
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
    
    /* Read (pseudo,mdp) : */
    public function readInfoClient($pseudo,$mdp){
        try{
           $query = "SELECT * FROM client WHERE pseudo=:pseudo AND mdp=:mdp ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$pseudo);
           $resultset->bindValue(2,$mdp);
           $resultset->execute();
           $data=$resultset->fetch();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* ReadAll) : */
    public function readAll(){
        try{
           $query = "SELECT * FROM client";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
}
