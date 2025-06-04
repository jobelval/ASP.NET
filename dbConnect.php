<?php
    define ("HOST","localhost");
    define("USER","root");
    define("PASSWORD","");
    define("DB","hopital");



    function connexion(){
        $con = new mysqli(HOST,USER,PASSWORD,DB);

        if(!$con){
            die("Echec de connexion");
        }
        else {
            //$con->select_db("gestion_pòlmarenniste";)
            //echo"Connexion reussie";
            return $con;
        }

        

    }
    //$con = connexion();







?>