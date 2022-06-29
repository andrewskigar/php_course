<?php

namespace LinkedList;

final class Node
{
    public function __construct(public $value, public ?Node $next = null)
    {
    }
}
