<?php

/*
 * basice controller
 * loads the models and views 
 */

class Controller {
    function model ($model){                                                                                // load modle page
        require_once ("../app/Model/" . $model . ".php");                                                   // require model file
        return new $model;                                                                                  // init a new class from modal page
    }

    function view ($view, $data = []){                                                                      // load viwe page
        if (file_exists("../app/View/" . $view . ".php")){
            require_once ("../app/View/" . $view . ".php");                                                 // require View file (load view file)
        } else {
            die("404 Error: Page dose not Exsits!");
        }
    }
}