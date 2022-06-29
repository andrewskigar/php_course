<?php

if (count($argv) !== 3) {
    exit;
}

$strings = explode(' ', $argv[1]);
$queries = explode(' ', $argv[2]);

$results = [];
foreach ($queries as $query) {
    $counter = 0;
    foreach ($strings as $string) {
        if ($string === $query) {
            $counter++;
        }
    }

    $results[] = $counter;
}

if ($results) {
    foreach ($results as $result) {
        echo "{$result}\n";
    }
}
