<?php

class VueHistorique {
    
    private $_db;
    private $_articleArray=array();
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
    
    /* ReadAll (by idClient) : */
    /*public function getListePanier($id){
        try{
           $query = "SELECT * FROM vue_panier WHERE id_client=:id ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$id);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }*/
}
