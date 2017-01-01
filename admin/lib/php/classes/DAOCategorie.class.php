<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAOCategorie{
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
    
    /* Create */
    public function create_category($intitule){
        $retour=null;
        try{
            $query="SELECT create_categorie(:intitule) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(1,$intitule);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Read : */
    public function read($idCat){
        try{
           $query = "SELECT * FROM categorie WHERE id_categorie=:idCat ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idCat);
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
           $query = "SELECT * FROM categorie ";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* Update */
    public function update_category($idCat,$intitule){
        try{
           $query = "SELECT update_categorie(:idcategorie,:intitule)";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idCat);
           $resultset->bindValue(2,$intitule);
           $resultset->execute();
           $data=$resultset->fetch();
            return $data;
        } catch (PDOException $ex) {
            print $ex->getMessage();
           alert("alert-danger","La modification n'a pas été effectuée.");
        }
    }
    
    /* Delete : */
    public function delete($idCat){
        $retour=null;
        try{
            $query="SELECT del_categorie(:idCat)";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(1,$idCat);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
             alert("alert-danger","La suppression n'a pas été effectuée. Il se peut que cette catégorie contient un ou plusieurs articles");
        }
        return $retour;
    }
}