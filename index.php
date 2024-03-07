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
echo "<a href='results-history.php'><button>История</button></a>";
//end

// Cr raw ongoing table
$result = executeSql($conn, $crRawOngoingSql);
echo "<hr align='left' width='700px'>";
echo "<table style='width:700px;'>";
echo "<caption>Текущее положение</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Bets</th><th>Days</th><th>Won</th><th>Lost</th><th>Units</th><th>ROI</th></tr>";

foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
}

echo "</table>";
// table end

// Cr raw ongoing 2nd month table
$result = executeSql($conn, $crRawOngoing2ndMonthSql);
if (count($result) > 0) {
  echo "<hr align='left' width='700px'>";
  echo "<table style='width:700px;'>";
  echo "<caption>Второй месячный конкурс</caption>";
  echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Bets</th><th>Days</th><th>Won</th><th>Lost</th><th>Units</th><th>ROI</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
      echo $v;
  }

  echo "</table>";
}
// table end

// Winning strick
$result = executeSql($conn, $crWinningStrickSql);
echo "<hr align='left' width='700px'>"; 
echo "<div class='winning-strick'>";
echo "<table style='width: 400px;'>";
echo "<caption>Серия</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Active</th><th>Avg Odds</th><th>Length</th></tr>";

foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
}

echo "</table>";
echo "</div>";  
// table end

// Biggest odd
$result = executeSql($conn, $crBiggestOddSql);
echo "<div>";
echo "<table style='width:270px;'>";
echo "<caption>Высший коэффициент</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th class='odds'>Odds</th></tr>";

foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
}

echo "</table>";
echo "</div>"; 
// table end

// In play bets
$result = executeSql($conn, $inPlayBetsSql);
if (count($result) > 0) {
    echo "<hr align='left' width='980px'>";
    echo "<div class='in-play-bets'>";
    echo "<table style='width:980px;'>";
    echo "<caption>Сейчас играют</caption>";
    echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Scheduled</th><th class='event'>Event</th><th class='market'>Market</th><th>Pick</th><th>Odds</th><th>Predicted</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
  }

  echo "</table>";
  echo "</div>"; 
}
// table end

// Future bets
$result = executeSql($conn, $futureBetsSql);
if (count($result) > 0) {
    echo "<hr align='left' width='980px'>";
    echo "<div class='future-bets'>";
    echo "<table style='width:980px;'>";
    echo "<caption>Будущие события</caption>";
    echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Scheduled</th><th class='event'>Event</th><th class='market'>Market</th><th>Pick</th><th>Odds</th><th>Predicted</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
  }

  echo "</table>";
  echo "</div>"; 
}
// table end

// Recent bets
$result = executeSql($conn, $recentBetsSql);
if (count($result) > 0) {
    echo "<hr align='left' width='980px'>";
    echo "<div class='recent-bets'>";
    echo "<table style='width:980px;'>";
    echo "<caption>Последние результаты (за 24 часа)</caption>";
    echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th class='result'>Result</th><th>Odds</th><th class='event'>Event</th><th class='market'>Market</th><th>Pick</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
  }

  echo "</table>";
  echo "</div>"; 
}
// table end

// Dop stavki
$result = executeSql($conn, $dopStavkiSql);
if (count($result) > 0) {
    echo "<hr align='left' width='700px'>";
    echo "<div class='dop-stavki'>";
    echo "<table style='width:315px;'>";
    echo "<caption>Доп. ставки</caption>";
    echo "<tr><th class='th-nickname'>Nickname</th><th>Bets</th><th>Difference</th></tr>";
    
  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
  }

  echo "</table>";
  echo "</div>"; 
}
// table end

// Check rules table
$result = executeSql($conn, $checkRulesSql);
if (count($result) > 0) {
    echo "<hr align='left' width='980px'>";
    echo "<div class='check-rules'>";
    echo "<table style='width:980px;'>";
    echo "<caption>Проверка правил</caption>";
    echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th class='date'>Scheduled</th><th class='event'>Event</th><th>Rule Description</th></tr>";

  foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
  }

  echo "</table>";
  echo "</div>"; 
}
// table end

echo "</div>";
echo "</body>";
$conn = null;
?>