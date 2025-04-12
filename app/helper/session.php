<?php

session_start();

function flash ($name = '', $message = '', $class = 'alert alert-success'){

    if (!empty($name)){                                                                                     // create new session message: 
        if (!empty($message) and empty($_SESSION[$name])){
            if (!empty($_SESSION[$name])){                                                                  // unset last session
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])){                                                       // unset session class
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        }
    } 
    
    if (empty($message) and !empty($_SESSION[$name])){                                                      // call session message: 
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';

        echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';


        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
    }
}

function is_user_logged_in (){
    if (isset($_SESSION['user_id'])){
        return true;
    }
    return false;
}