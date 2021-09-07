<?php

class PostController{
    /* BRING the list of the columns of the table to change */
    static public function getColumnsData($table, $db){
        $response= PostModel::getColumnsData($table, $db);
        return $response;
    } 
    /* POST petition for create data */ 
    public function postData($table, $data){
        $response= PostModel :: postData($table, $data);
        $return= new PostController();
        $return -> responseData($response, "POST");
    }

    /* POST petition for create register */ 
    public function postRegister($table, $data){
        if(isset($data["password_user"]) && $data["password_user"] != null){
            $crypt= crypt($data["password_user"], '$2a$07$pdgtwzaldisoqrtrswqpxzasdte$');
            $data["password_user"]= $crypt;
            $response= PostModel :: postData($table, $data);
            $return= new PostController();
            $return -> responseData($response, "POST");
        }
    }

    /* response of de data */
    public function responseData($response, $metodh){
        if(!empty($response)){
            $json = array (
                "status" => 200,
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found",
                "metodh" => $metodh
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

}