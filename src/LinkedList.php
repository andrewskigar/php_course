<?php

namespace App;

class LinkedList
{

    public function __construct(public ?Node $head = null)
    {
    }

    public function print(): void
    {
        $node = $this->head;

        while ($node) {
            echo $node->value;

            if ($node = $node->next) {
                echo ' -> ';
            }
        }

        echo "\n";
    }

    public function insertAfter($value, Node $after): Node
    {
        $after->next = new Node($value, $after->next);

        return $after->next;
    }

    public function prepend($value): Node
    {
        $this->head = $node = new Node($value, $this->head);

        return $node;
    }

    public function append(string $value, ?Node $loopNode = null): Node
    {
        if (!$node = $this->head) {
            return $this->prepend($value);
        }

        while ($node->next ?? null) {
            $node = $node->next;
        }

        $created = $this->insertAfter($value, $node);

        if ($loopNode) {
            $created->next = $loopNode;
        }

        return $created;
    }

    public function loopLength(): int
    {
        $set = [];
        $index = 0;

        $currentNode = $this->head;

        while ($currentNode) {
            $set[md5(serialize($currentNode))] = ++$index;

            if (array_key_exists(md5(serialize($currentNode->next)), $set)) {
                return $set[md5(serialize($currentNode))] - $set[md5(serialize($currentNode->next))] + 1;
            }

            $currentNode = $currentNode->next;
        }

        return 0;
    }
}
