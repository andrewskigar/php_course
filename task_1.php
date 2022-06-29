<?php

require_once "Node.php";
require_once "LinkedList.php";

use LinkedList\LinkedList;

$list = new LinkedList();

$node = $list->add('10');
$node = $list->add('20');
$node = $list->add('30');

$list->print();
