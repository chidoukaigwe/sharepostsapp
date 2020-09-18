<?php
//This is the base controller - this loads the models and views
  class Controller{

    //Load model
    public function model($model) {

      //Require model file
      require_once '../app/models/' . $model . '.php';

      //Instantiate model
      return new $model();

    }

    //Load view
    //$view = file
    //$data [] - will enable us to pass in dynamic values into our view
    public function view($view, $data = []) {

      //Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else{
        //view does not exists
        die('View does not exist');
      }
    }

  } //End Of Class Controller

 ?>
