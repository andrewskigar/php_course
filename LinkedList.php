<?php

namespace LinkedList;

final class LinkedList
{
    public function __construct(public ?Node $head = null)
    {
    }

    public function add($value): Node
    {
        $node = new Node($value, null);
        if ($this->head === null) {
            $this->head = $node;
        } else {
            $current = $this->head;
            while($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $node;
        }

        return $node;
    }

    public function print()
    {
        $node = $this->head;

        while ($node) {
            echo $node->value;
            if ($node = $node->next) {
                echo "\n";
            }
        }

        echo "\n";
    }
}
