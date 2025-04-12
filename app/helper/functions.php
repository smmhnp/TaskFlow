<?php

function Role ($role){
    switch ($role):
        case 'admin':
            $rol = 'مدیر پروژه';
            break;
        case 'developer':
            $rol = 'توسعه دهنده';
            break;
        case 'user':
            $rol = 'کاربر عادی';
            break;   
    endswitch;

    echo $rol;
}