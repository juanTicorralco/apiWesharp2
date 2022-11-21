<?php

class RouetesController{
    
    /*  ruta principal */

    public function index(){
        include "routes/route.php";
    }

    static public function dbPrincipal(){
        return "wesharp2";
    }

    static public function tableProtected(){
        $table = ["users","disputes","messages","orders","sales"];
        return $table;
    }
}