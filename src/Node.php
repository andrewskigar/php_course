<?php

namespace App;

class Node
{
    public function __construct(public string $value, public ?Node $next = null) {}
}
