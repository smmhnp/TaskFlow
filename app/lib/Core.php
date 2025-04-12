<?php

/*
 * App Core class
 * Create URL and Load Core controller
 * URL format - controller - method - param
 */

class Core {
    protected $CurrentController = 'tasks';                                                             // default page controller
    protected $CurrentMethod = "index";                                                                 // default method on controller page (like Edit or Delete or ... )
    protected $param = [];                                                                              // save parameter as url (like .../courses/edit/3 -> edit and 3 save in " $param ")
 
    function __construct (){                                                                            // whene object is define, execute this function :
        $url = $this -> GetURL();                                                                       // resive GetURL function 
        
        if (isset($url[0])){
            if (file_exists("../app/Controller/" . ucwords($url[0] . ".php"))){
                $this -> CurrentController = ucwords($url[0]);                                          // check exists file in Controller folder if exists init CurrentController var
                unset($url[0]);
            }
        }

        require_once ("../app/Controller/" . $this -> CurrentController . ".php");                      // include file from Controller folder
        $this -> CurrentController = new $this -> CurrentController;                                    // define class from controller folder by CurrentController (for example: client enter "courses" this line equal to -> Courses = new Courses;)

        if (isset($url[1])){
            if (method_exists($this -> CurrentController, $url[1])){                                    // if entered method exists on controller page -> current method = entered value
                $this -> CurrentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this -> param = $url ? array_values($url) : [];                                                // if exists parameter in url svae in $param var (like -> url : address/courses/edit/3 -> courses are controller & edit are method & 3 are param)

        call_user_func_array([$this -> CurrentController, $this -> CurrentMethod], $this -> param);     // in current controller on current method get this parameter to method on controller class
    }
        
    function GetURL (){                                                                                 // for get url and menypuliting on url
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');                                                            // delete " / " end of url
            $url = filter_var($url, FILTER_SANITIZE_URL);                                               // filter unallowable url character like persion alphabet (if use prsion alphbet in url comment this line)
            $url = explode('/', $url);                                                                  // separate url string by " / "
            return $url;
        }
    }
}