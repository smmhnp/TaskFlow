<?php

function color_preference_style ($preference){
                        
    switch ($preference) :
        case 'بالا' :
            $color = 'high';
            break;
        case 'متوسط' :
            $color = 'medium';
            break;
        case 'پایین' :
            $color = 'low';
            break;
    endswitch;

    echo $color;
}

function color_status_style ($preference){
                        
    switch ($preference) :
        case 'برای انجام' :
            $color = 'todo';
            break;
        case 'در حال انجام' :
            $color = 'inprogress';
            break;
        case 'بازبینی' :
            $color = 'review';
            break;
        case 'انجام شده' :
            $color = 'done';
            break;
    endswitch;

    echo $color;
}