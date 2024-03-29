<?php
require_once "conection.php";

class PostModel{
     /* BRING the list of the columns of the table to change */
     static public function getColumnsData($table, $db){
         return Conection:: connect()-> query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$db' AND table_name= '$table'")->fetchAll(PDO::FETCH_OBJ);
     }
    /* POST petition for create data */ 
    static public function postData($table, $data){

        $columns="(";
        $params="(";

        foreach($data as $key=>$value){
            $columns .=$key.",";
            $params .=":".$key.",";
        }

        $columns=substr($columns, 0, -1);
        $params=substr($params, 0, -1);

        $columns .= ")";
        $params .=")";

        $link=  Conection :: connect();
        $stmt= $link-> prepare("INSERT INTO $table $columns VALUES $params");

        foreach($data as $key => $value){
            $stmt -> bindParam(":".$key, $data[$key], PDO::PARAM_STR);
        }

        if($stmt->execute()){
            $return = array(
                "idlast" => $link->lastInsertId(),
                "comment" => "The Proces as Successfull"
            );
            return $return;
            $stmt -> close();

        }else{
            echo Conection::connect() -> errorInfo();
        }

    }
}