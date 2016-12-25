<?php

class ArticlesDB {
    
    private $_db;
    private $_typeArray=array();
    private $_variable = "valuer";
    
    public function __construct($cnx){
        $this->_db=$cnx;
    }
    
    public function GetListe_Categorie(){
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