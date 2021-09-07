<?php
class GetController {
    /* GET Petition Not Filter */
    public function getData($table, $orderBy, $orderMode, $startAt, $endAt){
        
        $response = GetModel::getData($table, $orderBy, $orderMode, $startAt, $endAt);

        if( $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$table' doesn't exist" ||
            $response=="SQLSTATE[42S22]: Column not found: 1054 Unknown column '$orderBy' in 'order clause'" ||
            $response=="SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '$orderMode' at line 1"){
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }else if(!empty($response)){
            $json = array (
                "status" => 200,
                "total" => count($response),
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* GET Petition with Filter */
    public function getFilterData($table, $linkTo, $equalTo,$orderBy, $orderMode, $startAt, $endAt){
        
        $response = GetModel::getFilterData($table, $linkTo, $equalTo,$orderBy, $orderMode, $startAt, $endAt);
        if( $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$table' doesn't exist" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$linkTo' in 'where clause'"){
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }else if(!empty($response)){
            $json = array (
                "status" => 200,
                "total" => count($response),
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* GET Petition relation tables not Filter */
    public function getRelData($rel, $type,$orderBy, $orderMode, $startAt, $endAt){
        
        $response = GetModel::getRelData($rel, $type, $orderBy, $orderMode, $startAt, $endAt);
        $relArray= explode(",", $rel);
        $typeArray=explode(",", $type);

        $on1a= $relArray[0].".id_".$typeArray[1]."_".$typeArray[0];
        $on1b= $relArray[1].".id_".$typeArray[1];
        if(isset($relArray[2])){
            $t1=$relArray[2];
            $on2a= $relArray[0].".id_".$typeArray[2]."_".$typeArray[0];
            $on2b= $relArray[2].".id_".$typeArray[2];
        }
        else{
            $t1=0;
            $on2a= 0;
            $on2b= 0;
        }
        if(isset($relArray[3])){
            $t2=$relArray[3];
            $on3a=$relArray[0].".id_".$typeArray[3]."_".$typeArray[0];
            $on3b=$relArray[3].".id_".$typeArray[3];
        }else{
            $t2=0;
            $on3a=0;
            $on3b=0;
        }
       
        if( $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$relArray[0]' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$relArray[1]' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$t1' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$t2' doesn't exist" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on1a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on1b' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on2a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on2b' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on3a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on3b' in 'on clause'" ){
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }else if(!empty($response)){
            $json = array (
                "status" => 200,
                "total" => count($response),
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* GET Petition relation tables with Filter */
     public function getRelFilterData($rel, $type, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){
        
        $response = GetModel::getRelFilterData($rel, $type, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
        $relArray= explode(",", $rel);
        $typeArray=explode(",", $type);

        $on1a= $relArray[0].".id_".$typeArray[1]."_".$typeArray[0];
        $on1b= $relArray[1].".id_".$typeArray[1];
        if(isset($relArray[2])){
            $t1=$relArray[2];
            $on2a= $relArray[0].".id_".$typeArray[2]."_".$typeArray[0];
            $on2b= $relArray[2].".id_".$typeArray[2];
        }
        else{
            $t1=0;
            $on2a= 0;
            $on2b= 0;
        }
        if(isset($relArray[3])){
            $t2=$relArray[3];
            $on3a=$relArray[0].".id_".$typeArray[3]."_".$typeArray[0];
            $on3b=$relArray[3].".id_".$typeArray[3];
        }else{
            $t2=0;
            $on3a=0;
            $on3b=0;
        }
       
        if( $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$relArray[0]' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$relArray[1]' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$t1' doesn't exist" ||
            $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$t2' doesn't exist" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on1a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on1b' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on2a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on2b' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on3a' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$on3b' in 'on clause'" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$linkTo' in 'where clause'"){
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }else if(!empty($response)){
            $json = array (
                "status" => 200,
                "total" => count($response),
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    /* get petition for search */
    public function getSearchData($table, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt){
        
        $response = GetModel::getSearchData($table, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);
        if( $response == "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'wesharp2.$table' doesn't exist" ||
            $response == "SQLSTATE[42S22]: Column not found: 1054 Unknown column '$linkTo' in 'where clause'"){
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }else if(!empty($response)){
            $json = array (
                "status" => 200,
                "total" => count($response),
                "result" => $response
            );
        }else{
            $json = array (
                "status" => 404,
                "result" => "no found"
            );
        }

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}