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

// Results history
$result = executeSql($conn, $resultsHistory);
echo "<hr align='left' width='700px'>";
echo "<table style='width:700px;'>";
echo "<caption>История результатов</caption>";
echo "<tr><th class='place' rowspan='2'></th><th class='th-nickname' rowspan='2'>Contest</th><th class='th-nickname' rowspan='2'>Winner</th><th class='th-nickname' rowspan='2'>2nd place</th><th class='th-nickname' rowspan='2'>3rd place</th><th class='th-nickname' rowspan='2'>Streak</th><th class='biggest-odds' rowspan='2'>Biggest Odds</th><th colspan='3'>Month 1</th><th colspan='3'>Month 2</th></tr>";
echo "<tr><th class='th-nickname'>Winner</th><th class='th-nickname'>2nd place</th><th class='th-nickname'>3rd place</th><th class='th-nickname'>Winner</th><th class='th-nickname'>2nd place</th><th class='th-nickname'>3rd place</th></tr>";

foreach(new TableBuilder(new RecursiveArrayIterator($result)) as $k=>$v) {
    echo $v;
}

echo "</table>";

// table end

echo "</div>";
echo "</body>";
$conn = null;
?>