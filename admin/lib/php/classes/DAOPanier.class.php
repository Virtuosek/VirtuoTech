<?php

class DAOPanier{
    
    private $_db;
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }

    /* Create : */
    public function addToCart($idClient,$idArticle){
        $retour=array();
        try{
            $query="SELECT add_cart(:idClient,:idArticle) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idClient',$idClient);
            $sql->bindValue(':idArticle',$idArticle);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* ReadAll (by idClient) : */
    public function getListePanier($id){
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
    }
    
    /* Delete (idPanier) : */
    public function deleteFromCart($idPan){
        $retour=array();
        try{
            $query="SELECT del_cart(:idPanier) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idPanier',$idPan);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
    
    /* Delete (idArticle,idClient) : */
    public function deleteArticleFromCart($idArticle,$idClient){
        $retour=array();
        try{
            $query="SELECT del_cart_article(:idArticle,:idClient) as retour";
            $sql=$this->_db->prepare($query);
            $sql->bindValue(':idArticle',$idArticle);
            $sql->bindValue(':idClient',$idClient);
            $sql->execute();
            $retour=$sql->fetchColumn(0);
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        return $retour;
    }
}