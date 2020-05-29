<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/GrenobleHandiSport/ztest/public/css/calendar.css">
    <title></title>
  </head>
  <body>

    <nav class="navbar navbar-dark bg-primary mb-3">
      <a href="/GrenobleHandiSport/ztest/public/index.php" class="navbar-brand">Mon Calendrier</a>
    </nav>

    <?php

    require '../src/Calendar/Month.php';
    require '../src/Calendar/Events.php';
    $events = new Calendar\Events();
    $month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $start = $month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    $weeks = $month->getWeeks();
    $end = (clone $start)->modify('+'. (6+7*($weeks-1)) .' days');
    $events = $events->getEventsBetween($start,$end );
    var_dump($events);
     ?>

<div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
  <h1> <?= $month->toString(); ?> </h1>


  <?php //var_dump($month) ?>

  <div>
    <a href="/GrenobleHandiSport/ztest/public/index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year;?>" class ="btn btn-primary"> &lt;</a>
    <a href="/GrenobleHandiSport/ztest/public/index.php?month=<?= $month->nextMonth()->month;?>&year=<?= $month->nextMonth()->year;?>" class ="btn btn-primary"> &gt;</a>

  </div>
</div>



<table class="calendar__table calendar__table--<? $weeks;?> weeks">
<?php for ($i = 0; $i < $weeks; $i++): ?>
  <tr>
    <?php foreach($month->days as $k => $day):
        $date = (clone $start)->modify("+" . ($k + $i * 7) ."days");
       ?>
    <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?>">
      <?php if($i == 0): ?>
        <div class="calendar__weekday"><?= $day; ?> </div>
      <?php endif; ?>
      <div class="calendar__day"><?= $date->format('d'); ?></div>
    </td>
  <?php endforeach; ?>
  </tr>
<?php endfor; ?>
</table>


  </body>
</html>
