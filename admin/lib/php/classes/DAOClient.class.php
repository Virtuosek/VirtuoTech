<?php

class DAOClient {
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
        
    /* Create : */
    public function create_client($nom,$prenom,$pseudo,$mdp,$email,$typeCli){
        $retour=array();
        try{
            $query="SELECT create_client(:nom,:prenom,:pseudo,:mdp,:email,:typeCli) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':nom',$nom);
            $sql->bindValue(':prenom',$prenom);
            $sql->bindValue(':pseudo',$pseudo);
            $sql->bindValue(':mdp',md5($mdp));
            $sql->bindValue(':email',$email);
            $sql->bindValue(':typeCli',$typeCli);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Read : */
    public function readCli($idCli){
        try{
           $query = "SELECT * FROM client WHERE id_client=:idCli ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idCli);
           $resultset->execute();
           $data=$resultset->fetch();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
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
           $query = "SELECT * FROM client ORDER BY id_client";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* Update : */
    public function update_client($idClient,$nomClient,$prenom,$pseudo,$email,$idType){
        try{
           $query = "SELECT update_client(:idarticle,:nom,:prenom,:pseudo,:email,:type)";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idClient);
           $resultset->bindValue(2,$nomClient);
           $resultset->bindValue(3,$prenom);
           $resultset->bindValue(4,$pseudo);
           $resultset->bindValue(5,$email);
           $resultset->bindValue(6,$idType);
           $resultset->execute();
           $data=$resultset->fetch();
            return $data;
        } catch (PDOException $ex) {
           alert("alert-danger","La modification n'a pas été effectuée.");
        }
    }
    
    /* Delete : */
    public function delete_client($idCli){
        $retour=null;
        try{
            $query="SELECT del_client(:idCli)";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idCli',$idCli);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            ?>
            <span class="margin-center"></span>
            <div class="centrer alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Le client n'a pas été supprimé ! Il se peut qu'il ait commandé ou ajouté des articles à son panier.
                <a href="#" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh" onClick="window.location.href=window.location.href"></a>
            </div>
            <?php
        }
        return $retour;
    }
}
