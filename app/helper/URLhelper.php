<?php

function Redirect ($page){
    header('location: ' . URLROOT . $page);
}