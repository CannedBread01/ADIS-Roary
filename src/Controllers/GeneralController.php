<?php
require_once __DIR__ . '/../Models/Roar.php';

class GeneralController{

    public static function displayHomepage(){
        $posts = Roar::getAllRoars();
        require __DIR__ . '/../Views/homepage.php';
    }

    public static function display404Page(){
        http_response_code(404);
        require __DIR__ . '/../Views/404.php';
    }
}
?>