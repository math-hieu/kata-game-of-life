<?php


namespace GameOfLife;


final class GridBuilder
{
    private $grid = [[]];

    public function addAliveCell($x, $y)
    {
        $this->grid[$x][$y] = new AliveCell();
    }

    public function build()
    {
        return new Grid($this->grid);
    }
}