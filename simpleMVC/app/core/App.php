<?php

/**
 * Class App
 * Routing
 */


class App
{


    protected $controller = 'home'; //Default Set Home Controller
    protected $method = 'index';    //Default Set Index Method
    protected $params = [];

    public function __construct(){
        $url = $this->parseUrl();
        //print_r($url);


        //Check if controller exists and file exists
        if(file_exists('../app/controllers/'. $url[0] .'.php')){

            $this->controller = $url[0];
            unset($url[0]);
        }


        require_once '../app/controllers/'. $this->controller .'.php';

        $this->controller = new $this->controller;

        //var_dump($this->controller);

        //If method exists in url and exists in class
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //print_r($url);
        $this->params = $url ? array_values($url) : [];//rebase params array or set one empty element

        call_user_func_array([$this->controller, $this->method], $this->params);


    }

    public function parseUrl(){//Converts Url to Array

        if(isset($_GET['url'])){
            //echo $_GET['url'];

            return $url = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}