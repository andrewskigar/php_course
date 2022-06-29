<?php

require_once "Queue.php";

use Queue\Queue;

$queue = new Queue();

if (count($argv) !== 2) {
    exit;
}

$data = file_get_contents($argv[1]);
$lines = explode("\n", $data);

if (count($lines) === 0) {
    exit;
}

for ($i = 1; $i <= (int)$lines[0]; $i++)  {
    $command = explode(' ', $lines[$i]);

    switch(trim($command[0])) {
        case '1':
            $queue->enqueue((int) $command[1]);
            break;
        case '2':
            $queue->dequeue();
            break;
        case '3':
            echo $queue->print() . "\n";
            break;
    }
}
