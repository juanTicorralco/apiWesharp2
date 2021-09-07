<?php 

$routesArray = explode("/" , $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/* when it doesnt have any petition to the api*/
if(count($routesArray)==0){
    $json = array (
        "status" => 404,
        "result" => "not found"
    );
    
    echo json_encode($json, http_response_code($json["status"]));
    return;
}else{                          /* when it has a petition to the api */
     /* petition GET */
     if(count($routesArray)==1 && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="GET"){
        
        /* GET Petition with filter */
        if(isset($_GET['linkTo']) && isset($_GET['equalTo']) && !isset($_GET['rel']) && !isset($_GET['type'])){

             /* GET Order Tables  */
             if(isset($_GET["orderBy"]) && isset($_GET["orderMode"])){
                $orderBy=$_GET["orderBy"];
                $orderMode=$_GET["orderMode"];
            }else{
                $orderBy=null;
                $orderMode=null;
            }
            /* GET star and ent at  */
            if(isset($_GET["startAt"]) && isset($_GET["endAt"])){
                $startAt=$_GET["startAt"];
                $endAt=$_GET["endAt"];
            }else{
                $startAt=null;
                $endAt=null;
            }
            $response = new GetController();
            $response -> getFilterData(explode("?", $routesArray[1])[0], $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

        }else if(isset($_GET['rel']) && isset($_GET['type']) && explode("?", $routesArray[1])[0] == "relations" && !isset($_GET['linkTo']) && !isset($_GET['equalTo'])){
            /* Get Petition of relation tables not filter */
            if(isset($_GET["orderBy"]) && isset($_GET["orderMode"])){
                $orderBy=$_GET["orderBy"];
                $orderMode=$_GET["orderMode"];
            }else{
                $orderBy=null;
                $orderMode=null;
            }
             /* GET star and ent at  */
             if(isset($_GET["startAt"]) && isset($_GET["endAt"])){
                $startAt=$_GET["startAt"];
                $endAt=$_GET["endAt"];
            }else{
                $startAt=null;
                $endAt=null;
            }
            $response = new GetController();
            $response -> getRelData($_GET["rel"], $_GET["type"],$orderBy, $orderMode, $startAt, $endAt);

        }else if(isset($_GET['rel']) && isset($_GET['type']) && explode("?", $routesArray[1])[0] == "relations" && isset($_GET['linkTo']) && isset($_GET['equalTo'])){
            /* Get Petition of relation tables with filter */
             /* GET Order Tables  */
             if(isset($_GET["orderBy"]) && isset($_GET["orderMode"])){
                $orderBy=$_GET["orderBy"];
                $orderMode=$_GET["orderMode"];
            }else{
                $orderBy=null;
                $orderMode=null;
            }
             /* GET star and ent at  */
             if(isset($_GET["startAt"]) && isset($_GET["endAt"])){
                $startAt=$_GET["startAt"];
                $endAt=$_GET["endAt"];
            }else{
                $startAt=null;
                $endAt=null;
            }
            $response = new GetController();
            $response -> getRelFilterData($_GET["rel"], $_GET["type"], $_GET["linkTo"], $_GET["equalTo"], $orderBy, $orderMode, $startAt, $endAt);

        }else if(isset($_GET['linkTo']) && isset($_GET['search'])){
            /* get petition for search */
            /* GET Order Tables  */
            if(isset($_GET["orderBy"]) && isset($_GET["orderMode"])){
                $orderBy=$_GET["orderBy"];
                $orderMode=$_GET["orderMode"];
            }else{
                $orderBy=null;
                $orderMode=null;
            }
             /* GET star and ent at  */
             if(isset($_GET["startAt"]) && isset($_GET["endAt"])){
                $startAt=$_GET["startAt"];
                $endAt=$_GET["endAt"];
            }else{
                $startAt=null;
                $endAt=null;
            }
            $response = new GetController();
            $response -> getSearchData(explode("?", $routesArray[1])[0], $_GET["linkTo"], $_GET["search"], $orderBy, $orderMode, $startAt, $endAt);
        }else{
            
            /* GET Petition not filter */
            /* GET Order Tables  */
            if(isset($_GET["orderBy"]) && isset($_GET["orderMode"])){
                $orderBy=$_GET["orderBy"];
                $orderMode=$_GET["orderMode"];
            }else{
                $orderBy=null;
                $orderMode=null;
            }
            /* GET star and ent at  */
            if(isset($_GET["startAt"]) && isset($_GET["endAt"])){
                $startAt=$_GET["startAt"];
                $endAt=$_GET["endAt"];
            }else{
                $startAt=null;
                $endAt=null;
            }

            $response= new GetController();
            $response -> getData(explode("?", $routesArray[1])[0], $orderBy, $orderMode, $startAt, $endAt);
        }    
    }

     /* petition POST */
     if(count($routesArray)==1 && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST"){
  
        /* BRING the list of the columns of the table to change */
        $columns=array();
        $dbPrincipal= RouetesController::dbPrincipal();
        $response= PostController::getColumnsData(explode("?", $routesArray[1])[0], $dbPrincipal);
      
        foreach($response as $key => $value){
            array_push($columns,$value->item);
        }
        array_shift($columns);
        array_pop($columns);
        //echo '<pre>'; print_r($columns); echo '</pre>';

        if(isset($_POST))
        /* validate that column names match the db */
        $count=0;
        foreach($columns as $key => $value){
            if(array_keys($_POST)[$key]==$value){
                $count++;
            }else {
                $json = array (
                    "status" => 404,
                    "result" => "Error: los campos no coinciden con la base de datos"
                );
                
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }
        }
        /* validate that the post variables match those of the db */
        if($count==count($columns)){
            /* we give response of the controller for insert data in a table */
            $response= new PostController();
            $response -> postData(explode("?", $routesArray[1])[0], $_POST);
        }

    }
     /* petition PUT */
     if(count($routesArray)==1 && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="PUT"){

        /* we ask about the id */
        if( isset($_GET["id"]) && isset($_GET["nameId"])){
            /* Validated to exist id */
            $table= explode("?", $routesArray[1])[0];
            $linkTo=$_GET["nameId"];
            $equalTo=$_GET["id"];
            $orderBy=null;
            $orderMode=null;
            $startAt=null;
            $endAt=null;

            $response= PutController:: getFilterData($table, $linkTo, $equalTo,$orderBy, $orderMode, $startAt, $endAt);
            
            if($response){
                $data=array();
                parse_str(file_get_contents('php://input'), $data);
                
                /* We request controller response to edit any table */
                $response=new PutController();
                $response -> putData(explode("?", $routesArray[1])[0], $data, $_GET["id"], $_GET["nameId"] );
            }else {
                $json=array(
                    'status' => 400,
                    'result' => "Error: The id is not found in de database"
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }
        }
    }
     /* petition DELETE */
     if(count($routesArray)==1 && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="DELETE"){
        $json = array (
            "status" => 200,
            "result" => "DELETE"
        );
        
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}
?>