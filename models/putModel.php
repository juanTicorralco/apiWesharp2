<?php

require_once "conection.php";
class PutModel{
    /* PUT petition for modificated data */ 
    static public function putData($table, $data, $id, $nameId){

        $set="";
        foreach($data as $key => $value){
            $set .= $key." = :".$key.",";
        }

        $set= substr($set, 0, -1);

        $stmt= Conection::connect()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach($data as $key => $value){
            $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);
        }
        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_STR);

        if($stmt->execute()){
            return "The Process was Successfull";
        }else {
            echo Conection::connect()->errorinfo();
        }
    }
}