<?php

namespace Calendar;

class Events{

  private $pdo;

  public function __construct(\PDO $pdo){
    $this->pdo = $pdo;
  }

  public function getEventsBetween (\DateTime $start, \DateTime $end): array {
//    try {
//      $pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ]);
//    } catch (\Exception $e) {
//      die('Erreur ' . $e->getMessage());
//    }

    $sql = "SELECT * FROM events WHERE start  BETWEEN' {$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
    $statement = $this->pdo->query($sql);
    $results = $statement->fetchAll();
    return $results;
  }

  //on écrit 2x des foncions presques identiques car la 1e on la garde de coté, elle pourra être utile plus tard puisqu'elle récupère juste les évenements
  public function getEventsBetweenByDay (\DateTime $start, \DateTime $end): array {
    $events=$this->getEventsBetween($start, $end);
    $days=[];
    foreach ($events as $event) {
      $date = explode(' ', $event['start'])[0];
      if (!isset ($days[$date])){
        $days[$date]=[$event];
      }
      else {
        $days[$date][]=$event;
      }
    }
    return $days;
  }

  public function find(int $id): Event
  {
    //require 'Event.php';
    //pdo
    $statement = $this->pdo->query("SELECT * FROM events WHERE id=$id LIMIT 1");
    $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
    $result=$statement->fetch();
    if ($result === false) {
      throw new \Exception("Aucun résultat trouvé");
    }
    return $result;
  }

}


 ?>
