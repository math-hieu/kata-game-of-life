<?php


namespace GameOfLife;


final class Grid
{
    private $grid = [[]];

    public function get(Coordinate $x, Coordinate $y)
    {
        if (!isset($this->grid[$x->getValue()][$y->getValue()])) {
            return new DeadCell();
        }

        return $this->grid[$x->getValue()][$y->getValue()];
    }

    public function add(Cell $cell, Coordinate $x, Coordinate $y)
    {
        $this->grid[$x->getValue()][$y->getValue()] = $cell;
    }

    public function nextRound()
    {
        foreach ($this->grid as $x => $valueX) {
            foreach ($valueX as $y => $valueY) {
                $this->grid[$x][$y] = $valueY->nextState($this->nbNeighborhood($x, $y));
            }
        }
    }

    private function nbNeighborhood($x, $y)
    {
        $nbNeighborhood = 0;
        $neighborhood = [
            $this->get(new Coordinate($x - 1), new Coordinate($y - 1)),
            $this->get(new Coordinate($x - 1), new Coordinate($y)),
            $this->get(new Coordinate($x - 1), new Coordinate($y + 1)),
            $this->get(new Coordinate($x), new Coordinate($y - 1)),
            $this->get(new Coordinate($x), new Coordinate($y + 1)),
            $this->get(new Coordinate($x + 1), new Coordinate($y - 1)),
            $this->get(new Coordinate($x + 1), new Coordinate($y)),
            $this->get(new Coordinate($x + 1), new Coordinate($y + 1)),
        ];

        foreach ($neighborhood as $cell) {
            if ($cell->isAlive()) {
                $nbNeighborhood++;
            }
        }

        return $nbNeighborhood;
    }
}