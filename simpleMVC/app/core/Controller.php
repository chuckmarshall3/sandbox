<?php
/**
 *
 */

class Controller
{

    //Instantiate Model
    public function model($model){

        require_once '../app/models/'. $model .'.php';
        return new $model();

    }

    //Instantiate View
    public function view($view, $data = []){


        require_once '../app/views/'.$view.'.php';

    }

}