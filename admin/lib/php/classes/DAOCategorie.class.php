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
}