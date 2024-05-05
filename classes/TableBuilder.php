<?php

class TableBuilder extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

#[\ReturnTypeWillChange]
  function current() {
    $value = parent::current();

    if (is_numeric($value)) {
      
      // Convert to float to remove unnecessary zeros
      $floatValue = floatval($value);
      
      // If the number is a whole number, remove decimal and trailing zeros
      if ($floatValue == intval($value)) {
        $value = intval($value);
      }
    }
    return "<td>" . $value . "</td>";
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

?>