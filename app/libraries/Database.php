<?php
  /*
    *PDO Database class
    * Connect to database
    *Create prepared stastements
    *Bind Values
    *Return rows and results (i.e execute)
  */

  class Database{

    private $host =  DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
      //Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = array(
        //this can increase performance by checking to see if a connection already exists
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      // Create PDO instance
      try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
      }catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }
    } // end of constructor

    //Prepare statement with query
    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values
    public function bind($param, $value, $type = null){

      if(is_null($type)){

        switch (true) {
          case is_int($value):
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
            break;
          default:
            $type = PDO::PARAM_STR;
        }

      } // end if

      $this->stmt->bindValue($param, $value, $type);

    } // end bind func

    // Execute the prepared statement
    public function execute(){
      return $this->stmt->execute();
    }

    //Get Result Set As Array Of Objects
    public function resultSet(){
      $this->execute();
      //we want the output to be an array objects NOT an associative array
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //Get Single record as object
    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    //Get Row Count
    public function rowCount(){
      //rowCount() is a method that is part of PDO
      return $this->stmt->rowCount();
    }

  }// end of DB class
