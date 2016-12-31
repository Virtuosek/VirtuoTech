<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class VueArticle{
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
    
    /* Create : */
    public function create_article($nom,$description,$image,$categorie,$prix){
        $retour=array();
        try{
            $query="SELECT create_article(:nom,:description,:image,:categorie,:prix) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':nom',$nom);
            $sql->bindValue(':description',$description);
            $sql->bindValue(':image',$image);
            $sql->bindValue(':categorie',$categorie);
            $sql->bindValue(':prix',$prix);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Read (idArticle)  wrong function*/
    public function readArticle($idArticle){
        try{
           $query = "SELECT * FROM vue_articles WHERE id_article=:idArticle ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idArticle);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* Read (idArticle) : */
    public function readArticle2($idArticle){
        try{
           $query = "SELECT * FROM vue_articles WHERE id_article=:idArticle ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idArticle);
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
           $query = "SELECT * FROM article ORDER BY id_article";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* ReadAll (idCategorie) : */
    public function getListeArticle($id){
        try{
           $query = "SELECT * FROM vue_articles WHERE id_categorie=:id ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$id);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
    /* Update : */
     public function updateArticle($idarticle,$nomUp,$descriUp,$imageUp,$catUp,$prixUp){
        $date=0;
        try{
           $query = "SELECT update_article(:idarticle,:nom,:description,:image,:categorie,:prix)";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idarticle);
           $resultset->bindValue(2,$nomUp);
           $resultset->bindValue(3,$descriUp);
           $resultset->bindValue(4,$imageUp);
           $resultset->bindValue(5,$catUp);
           $resultset->bindValue(6,$prixUp);
           $resultset->execute();
           $data=$resultset->fetch();
            return $data;
        } catch (PDOException $ex) {
           alert("alert-danger","La modification n'a pas été effectuée.");
        }
    }
    
    /* Delete (idArticle)*/
    public function deleteArticle($idArticle){
        $retour=1;
        try{
            $query = "SELECT del_article(:idArticle) as retour ";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idArticle',$idArticle);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            ?>
            <span class="margin-center"></span>
            <div class="centrer alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                L'article n'a pas été supprimé ! Il se peut qu'un client ait commandé ou ajouté cet article à son panier.
                <a href="#" data-dismiss="alert" class="btn btn-inverse btn-xs pull-left glyphicon glyphicon-refresh" onClick="window.location.href=window.location.href"></a>
            </div>
            <?php
        }
        return $retour;
    }
    
}
