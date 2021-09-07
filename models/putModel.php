<?php

require_once "conection.php";
class PutModel{
    /* PUT petition for modificated data */ 
    static public function putData($table, $data, $id, $nameId){
       


        $stmt= Conection::connect()->prepare("UPDATE $table SET name_category=:name_category, title_list_category=:title_list_category, url_category=:url_category, image_category=:image_category, views_category=:views_category WHERE $nameId=:$nameId");

        $stmt -> bindParam(":name_category", $data["name_category"], PDO::PARAM_STR);
        $stmt -> bindParam(":title_list_category", $data["title_list_category"], PDO::PARAM_STR);
        $stmt -> bindParam(":url_category", $data["url_category"], PDO::PARAM_STR);
        $stmt -> bindParam(":image_category", $data["image_category"], PDO::PARAM_STR);
        $stmt -> bindParam(":views_category", $data["views_category"], PDO::PARAM_STR);
        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);

      

        if($stmt->execute()){
            return "The Process was Successfull";
        }else {
            echo Conection::connect()->errorinfo();
        }
    }
}