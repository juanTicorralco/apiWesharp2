<?php
require_once "conection.php";

class DeleteModel{
    static public function deleteData($table, $id, $nameId){
        
        $stmt = Conection :: connect() -> prepare("DELETE FROM $table WHERE $nameId=:$nameId");
        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            return "The Process was Successfull";
        }else {
            return Conection::connect()->errorinfo();
        }
    }
}