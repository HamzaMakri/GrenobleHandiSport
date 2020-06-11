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

    $sql = "SELECT * FROM events WHERE start  BETWEEN' {$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ORDER BY start ASC";
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
    require '../src/Calendar/Event.php';
    //pdo
    $statement = $this->pdo->query("SELECT * FROM events WHERE id=$id LIMIT 1");
    $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
    $result=$statement->fetch();
    if ($result === false) {
      throw new \Exception("Aucun résultat trouvé");
    }
    return $result;
  }

// fonction qui nous aide à éditer sans avoir à se répéter trop de fois
  public function hydrate (Event $event, array $data) {
      $event->setName($data['name']);
      $event->setDescription($data['description']);
      $event->setStart(\DateTime::createFromFormat('Y-m-d H:i',
          $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
      $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i',
          $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
      return $event;
  }

  public function create (Event $event): bool {
      $statement = $this->pdo->prepare('INSERT INTO events (name, description, start, end) VALUES (?, ?, ?, ?)');
      return $statement->execute([
         $event->getName(),
         $event->getDescription(),
         $event->getStart()->format('Y-m-d H:i:s'),
         $event->getEnd()->format('Y-m-d H:i:s'),
      ]);
  }

  public function update (Event $event): bool {
      $statement = $this->pdo->prepare('UPDATE events SET name = ?, description = ?, start = ?, end = ? WHERE id = ?');
      return $statement->execute([
          $event->getName(),
          $event->getDescription(),
          $event->getStart()->format('Y-m-d H:i:s'),
          $event->getEnd()->format('Y-m-d H:i:s'),
          $event->getId()
      ]);
  }

  public function delete (Event $event): bool {

  }


}


 ?>
