<?php

class VueCommande {
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
        
    /* Create : */
    public function addCommande($idClient,$idArticle,$quantite,$date,$etat){
        //$retour=array();
        $retour=null;
        try{
            $query="SELECT create_commande(:idArticle,:idClient,:quantite,:date,:etat) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idArticle',$idArticle);
            $sql->bindValue(':idClient',$idClient);
            $sql->bindValue(':quantite',$quantite);
            $sql->bindValue(':date',$date);
            $sql->bindValue(':etat',$etat);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Read : */
     public function read($idCommande){
        try{
           $query = "SELECT * FROM commande WHERE id_commande=:id";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idCommande);
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
           $query = "SELECT * FROM commande ORDER BY id_commande";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
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
    
    /* Delete : */
    public function delete($idCom){
        $retour=null;
        try{
            $query="SELECT del_commande(:idCom)";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(1,$idCom);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
             print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Update */
    public function update_commande($idCom,$id_etat){
        try{
           $query = "SELECT update_commande(:idcommande,:idetat)";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idCom);
           $resultset->bindValue(2,$id_etat);
           $resultset->execute();
           $data=$resultset->fetch();
            return $data;
        } catch (PDOException $ex) {
            print $ex->getMessage();
           alert("alert-danger","La modification n'a pas été effectuée.");
        }
    }
}
