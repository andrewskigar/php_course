<?php

include_once __DIR__ . "/../vendor/autoload.php";

use App\LinkedList;

$linkedList = new LinkedList();
$linkedList->append('A');
$linkedList->append('B');
$linkedList->append('C');
$loopNode = $linkedList->append('1');
$linkedList->append('2');
$linkedList->append('3');
$linkedList->append('4');
$linkedList->append('5');
$linkedList->append('6');
$linkedList->append('7');
$linkedList->append('8');
$linkedList->append('9', $loopNode);

echo $linkedList->loopLength();
