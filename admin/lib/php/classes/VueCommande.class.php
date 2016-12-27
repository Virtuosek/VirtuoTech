<?php

class VueCommande {
    
    private $_db;
    private $_articleArray=array();
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
        
    /* Create : */
    public function addCommande($idClient,$idArticle,$quantite,$date){
        //$retour=array();
        $retour=null;
        try{
            $query="SELECT create_commande(:idArticle,:idClient,:quantite,:date) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idArticle',$idArticle);
            $sql->bindValue(':idClient',$idClient);
            $sql->bindValue(':quantite',$quantite);
            $sql->bindValue(':date',$date);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* ReadAll(idClient)*/
     public function getListeCommande($idClient){
        try{
           $query = "SELECT * FROM commande WHERE id_client=:id ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idClient);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
}
