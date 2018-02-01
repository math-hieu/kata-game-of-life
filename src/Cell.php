<?php

namespace GameOfLife;

abstract class Cell
{
    public function NextState(array $neighborhoods)
    {
        $aliveNeighborhoods = array_filter($neighborhoods, function($cell) {
            return $cell->isAlive();
        });

        if (count($aliveNeighborhoods) == 3) {
            return new AliveCell();
        }

        if (count($aliveNeighborhoods) == 2) {
            return $this;
        }

        return new DeadCell();
    }

    public abstract function isAlive();
}