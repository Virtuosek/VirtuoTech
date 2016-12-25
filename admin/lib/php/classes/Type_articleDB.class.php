<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Type_articleDB{
    
    private $_db; 
    private $_typeArray=array();
    private $_variable = "valuer";
    
    public function __construct($cnx){ 
        $this->_db=$cnx;
    }
    
    public function getType_article(){
        try{
           $query = "SELECT * FROM categorie";
           $resultset = $this->_db->prepare($query);
           $resultset->execute();
        } catch (PDOException $ex) {
            print $ex->getMessage();
        }
        
        while($data = $resultset->fetch()){
            try{
                $_infoArray[]=new InfoClient($data);
            }catch(PDOException $e){
                print $e->getMessage();
            }
        }
        
        return $_infoArray;
    }
}