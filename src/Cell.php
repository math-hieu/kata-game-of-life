<?php

namespace GameOfLife;

abstract class Cell
{
    public function NextState(int $nbNeighborhood)
    {
        if ($nbNeighborhood == 3) {
            return new AliveCell();
        }
        if ($nbNeighborhood == 2) {
            return $this;
        }

        return new DeadCell();
    }

    public abstract function isAlive();
}