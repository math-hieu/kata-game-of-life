<?php


namespace GameOfLife;


final class Grid
{
    private $grid;

    public function __construct(array $grid)
    {
        $this->grid = $grid;
    }

    public function get(int $x, int $y)
    {
        if (!isset($this->grid[$x][$y])) {
            return new DeadCell();
        }

        return $this->grid[$x][$y];
    }

    public function nextRound()
    {
        $round = [[]];
        foreach ($this->grid as $x => $valueX) {
            foreach ($valueX as $y => $valueY) {
                $round[$x][$y] = $valueY->nextState($this->getNeighborhoods($x, $y));
            }
        }

        return new self($round);
    }

    private function getNeighborhoods($x, $y)
    {
        return [
            $this->get($x - 1, $y - 1),
            $this->get($x - 1, $y),
            $this->get($x - 1, $y + 1),
            $this->get($x, $y - 1),
            $this->get($x, $y + 1),
            $this->get($x + 1, $y - 1),
            $this->get($x + 1, $y),
            $this->get($x + 1, $y + 1),
        ];
    }
}