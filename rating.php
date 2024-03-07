<?php

// Including other files
require_once 'classes/TableBuilder.php';
require_once 'methods.php';
require_once 'queries.php';

// Including scss styles
echo "<style>";
require_once 'style.scss';
echo "</style>";

// Creating container
echo "<body>";
echo "<div class='container'>";

$conn = createConnection();

// Last Updated
class LastUpdated extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }
  }
  
$result = executeSql($conn, $lastUpdatedSql);
foreach(new LastUpdated(new RecursiveArrayIterator($result)) as $k=>$v) {
    $date = strtotime($v);
    echo "<text>Обновлено (по Киеву): " . date('o, j M - H:i', $date) . "</text>";
}
//end

// Tabs
echo "<br>";
echo "<a href='index.php'><button>Главная</button></a>";
echo "<a href='rating.php'><button>Рейтинг</button></a>";
echo "<a href='https://docs.google.com/document/d/1J3_apsxu_qc3kgWmont9-IJXBZE1fKJg/edit?usp=sharing&ouid=115819350676974187090&rtpof=true&sd=true target='_blank'><button>Регламент</button></a>";
//end

// Rating live table
$result = executeSql($conn, $crRawOngoingSql);
if (count($result) > 0) {
  $result = executeSql($conn, $ratingLiveSql);
  echo "<hr align='left' width='700px'>";
  echo "<table style='width:700px;'>";
  echo "<caption>Рейтинг с учетом мест текущего конкурса</caption>";
  echo "<tr><th class='place' rowspan='2'></th><th class='th-nickname' rowspan='2'>Nickname</th><th colspan='4'>Current contest</th><th class='five-contests-points' rowspan='2'>5 contests points</th><th rowspan='2'>Rating</th></tr>";
  echo "<tr><th>Units</th><th>ROI</th><th>Place</th><th>Points</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
      echo $v;
  }

  echo "</table>";
}
// table end

// Rating static
$result = executeSql($conn, $ratingStaticSql);
echo "<hr align='left' width='700px'>";
echo "<table style='width:700px;'>";
echo "<caption>Рейтинг</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Cont 1</th><th>Cont 2</th><th>Cont 3</th><th>Cont 4</th><th>Cont 5</th><th>Cont 6</th><th>Rating</th></tr>";

foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
}

echo "</table>";
// table end

echo "</div>";
echo "</body>";
$conn = null;
?>