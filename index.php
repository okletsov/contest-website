<?php

$ini = parse_ini_file('app.ini');

echo "<style>";
include 'style.scss';
echo "</style>";

$servername = $ini['servername'];
$username = $ini['username'];
$password = $ini['password'];
$dbname = $ini['dbname'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

echo "<body>";
echo "<div class='container'>";

class LastUpdated extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
}

try {
  $stmt = $conn->prepare("SELECT max(convert_tz(bjl.finish_timestamp , 'UTC', 'Europe/Kiev')) as kiev_runtime from background_job_log bjl;");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new LastUpdated(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    $date = strtotime($v);
    echo "<text>Обновлено (по Киеву): " . date('j M - H:i', $date) . "</text>";
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}


echo "<hr align='left' width='700px'>";

echo "<table style='width:700px;'>";
echo "<caption>Текущее положение</caption>";
echo "<tr><th class='th-nickname'>Nickname</th><th>Bets</th><th>Days</th><th>Won</th><th>Lost</th><th>Units</th><th>ROI</th></tr>";

class Cr_raw_ongoing extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

#[\ReturnTypeWillChange]
  function current() {
    return "<td>" . parent::current(). "</td>";
  }

#[\ReturnTypeWillChange]
  function beginChildren() {
    echo "<tr>";
  }

#[\ReturnTypeWillChange]
  function endChildren() {
    echo "</tr>" . "\n";
  }
}

try {
  $stmt = $conn->prepare("SELECT * FROM cr_raw_ongoing");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new Cr_raw_ongoing(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
echo "</table>";

echo "<hr align='left' width='700px'>";

echo "<div class='winning-strick'>";
echo "<table style='width:335px;'>";
echo "<caption>Серия</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th>Avg Odds</th><th>Length</th></tr>";

class Cr_winning_strick extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

#[\ReturnTypeWillChange]
  function current() {
    return "<td>" . parent::current(). "</td>";
  }

#[\ReturnTypeWillChange]
  function beginChildren() {
    echo "<tr>";
  }

#[\ReturnTypeWillChange]
  function endChildren() {
    echo "</tr>" . "\n";
  }
}

try {
  $stmt = $conn->prepare("SELECT * FROM web_cr_winning_strick order by place;");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new Cr_winning_strick(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
echo "</table>";
echo "</div>";

echo "<div class='biggest-odd'>";
echo "<table style='width:315px;'>";
echo "<caption>Высший коэффициент</caption>";
echo "<tr><th class='place'></th><th class='th-nickname'>Nickname</th><th class='odds'>Odds</th></tr>";

class Cr_biggest_odd extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

#[\ReturnTypeWillChange]
  function current() {
    return "<td>" . parent::current(). "</td>";
  }

#[\ReturnTypeWillChange]
  function beginChildren() {
    echo "<tr>";
  }

#[\ReturnTypeWillChange]
  function endChildren() {
    echo "</tr>" . "\n";
  }
}

try {
  $stmt = $conn->prepare("SELECT * FROM web_cr_biggest_odd order by place;");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new Cr_biggest_odd(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
echo "</table>";
echo "</div>";

echo "<hr align='left' width='700px'>";

echo "<div class='dop-stavki'>";
echo "<table style='width:315px;'>";
echo "<caption>Доп. ставки</caption>";
echo "<tr><th class='th-nickname'>Nickname</th><th>Ставок</th><th>Разница</th></tr>";

class Dop_stavki extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

#[\ReturnTypeWillChange]
  function current() {
    return "<td>" . parent::current(). "</td>";
  }

#[\ReturnTypeWillChange]
  function beginChildren() {
    echo "<tr>";
  }

#[\ReturnTypeWillChange]
  function endChildren() {
    echo "</tr>" . "\n";
  }
}

try {
  $stmt = $conn->prepare("SELECT * FROM web_dop_stavki order by nickname;");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new Dop_stavki(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
echo "</table>";
echo "</div>";

echo "<hr align='left' width='700px'>";

echo "</div>";
echo "</body>";
$conn = null;
?>