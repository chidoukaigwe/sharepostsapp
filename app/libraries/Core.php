<?php

   /*
   *App Core class
   * Creates URL & loads core controller
   *URL FORMAT - /controller/method/params
   */

  class Core{

//The current controller and current method will change as our URl changes

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){

      $url = $this->getUrl();

      //Look in controllers for first value
      if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php' )){
        //if exists, set as controller
        $this->currentController = ucwords($url[0]);
        //Unset 0 index
        unset($url[0]);
      }

      //Require the controller
      require_once '../app/controllers/' . $this->currentController . '.php';

      //Instantiate controller class
      $this->currentController = new $this->currentController;

      //Check for second part of URl
      if(isset($url[1])){
        //Check to see if method exists in controller
        if(method_exists($this->currentController,$url[1])){
          $this->currentMethod = $url[1];
          //Unset 1 index
          unset($url[1]);
        }
      }

      // Get Params
      //array_values — Return all the values of an array
      $this->params = $url ? array_values($url) : [];

      //Call a callback with array of Params - call_user_func_array — Call a callback with an array of parameters
      //mixed call_user_func_array ( callable $callback , array $param_arr )
      // Calls the callback given by the first parameter with the parameters in param_arr.
      //Parameters:
      //callback The callable to be called.
      //param_arr The parameters to be passed to the callback, as an indexed array.
      call_user_func_array([$this->currentController,$this->currentMethod], $this->params);

    } // End of constructor

    public function getUrl(){
      if (isset($_GET['url'])) {
        //The rtrim() function removes whitespace or other predefined characters from the right side of a string.
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }

  } //End Of Core Class



 ?>
