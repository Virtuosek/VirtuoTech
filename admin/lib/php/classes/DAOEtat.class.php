<?php

class DAOEtat {
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
    
    /* Read : */
    public function read($idEtat){
        try{
           $query = "SELECT * FROM etat WHERE id_etat=:idEtat ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idEtat);
           $resultset->execute();
           $data=$resultset->fetch();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* ReadAll : */
    public function readAll(){
        try{
           $query = "SELECT * FROM etat";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
   
}
