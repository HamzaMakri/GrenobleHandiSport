<?php

  class User {

    public $nom;
    public $email;
    public $id;
    public $statut;

    public function __construct(string $nom, string $email, int $id, string $statut) {
      $this->nom = $nom;
      $this->email = $email;
      $this->id = $id;
      $this->statut = $statut;
    }
  }


  class MyDB2 extends MySQLi
  {

      private $pdo;

      function set_pdo (): PDO {
          return new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [
              \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
              \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
          ]);
      }

      public function __construct(){
          $this->pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [
              \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
              \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
          ]);
      }

      public function getAll($query, array $params)
      {
          $statement = $this->pdo->prepare($query);
          $statement->execute($params);
          return $statement->fetchAll();
      }

      public function getPdo()
      {
          return $this->pdo;
      }

      /**
       * This is called if the method cannot be found.
       * Pass it to PDO to handle.
       *
       * @param $name
       * @param $arguments
       */
      public function __call($name, $arguments)
      {
          return call_user_func(array($this->pdo, $name), $arguments);
      }



  }






// CLASS A SUPPRIMER
   class MyDB extends SQLite3 {

      function __construct() {
         $this->open('../data/sqlite/base.db');
      }
   }

 ?>
