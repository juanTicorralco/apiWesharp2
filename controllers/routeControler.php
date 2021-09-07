<?php

class RouetesController{
    
    /*  ruta principal */

    public function index(){
        include "routes/route.php";
    }
    static public function dbPrincipal(){
        return "wesharp2";
    }
    
}