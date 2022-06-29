<?php

namespace Queue;

class Queue {
    public int $front;
    public int $rear;

    public array $queue = [];

    public function __construct()
    {
        $this->rear = -1;
        $this->front = -1;
    }

    public function enqueue($x): void
    {
        $this->queue[++$this->rear] = $x;
    }

    public function dequeue(): ?int
    {
        if ($this->rear === $this->front){
            return null;
        } else {
            return $this->queue[++$this->front];
        }
    }

    public function print(): ?int
    {
        if ($this->rear === $this->front) {
            return null;
        }

        return $this->queue[$this->front + 1];
    }
}
