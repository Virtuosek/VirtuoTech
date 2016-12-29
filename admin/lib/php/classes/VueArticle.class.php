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
           $query = "SELECT * FROM article ";
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
    
    /* Delete (idArticle)*/
    public function deleteArticle($idArticle){
        try{
           $query = "SELECT * FROM del_article WHERE id_article=:id ";
           $resultset = $this->_db->prepare($query);
           $resultset->bindValue(1,$idArticle);
           $resultset->execute();
           $data=$resultset->fetchAll();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $data;
    }
    
}
