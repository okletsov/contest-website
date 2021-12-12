<?php

class TableBuilder extends RecursiveIteratorIterator {
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

?>