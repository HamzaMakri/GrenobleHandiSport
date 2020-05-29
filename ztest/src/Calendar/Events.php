<?php

namespace Calendar;

class Events{

  public function getEventsBetween (\DateTime $start, \DateTime $end): array {
    try {
      $pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ]);
    } catch (\Exception $e) {
      die('Erreur ' . $e->getMessage());
    }

    $sql = "SELECT * FROM events WHERE start  BETWEEN' {$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
    $statement = $pdo->query($sql);
    $results = $statement->fetchAll();
    return $results;
  }
}


 ?>
