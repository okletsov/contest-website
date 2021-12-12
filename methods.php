<?php

function createConnection() {

    $ini = parse_ini_file('app.ini');

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

    return $conn;
}

function executeSql($conn, $sql) {
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    return $stmt->fetchAll();
  }

?>