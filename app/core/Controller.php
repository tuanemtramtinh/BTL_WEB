<?php

class Controller {
  public function model($model){
    require_once './app/models/'.$model.'.php';
    return new $model();
  }

  public function view($view, $data=[]) {
    require_once './app/views/client/'.$view.'.php';
  }

  public function viewAdmin($view, $data=[]) {
    require_once './app/views/admin/'.$view.'.php';
  }
}