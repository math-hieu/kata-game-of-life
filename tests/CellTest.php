<?php

namespace GameOfLife;

use PHPUnit\Framework\TestCase;

final class CellTest extends TestCase
{
    /**
     * @test
     */
    public function a_cellule_is_dead_if_it_has_less_than_two_neighbour_alive()
    {
        $cell = new AliveCell();

        $this->assertEquals(new DeadCell(), $cell->NextState(1));
    }

    /**
     * @test
     */
    public function a_cellule_is_dead_if_it_has_more_than_three_neighbour_alive()
    {
        $cell = new AliveCell();

        $this->assertEquals(new DeadCell(), $cell->NextState(4));
    }

    /**
     * @test
     */
    public function a_dead_cellule_is_dead_if_it_has_two_neighbour_alive()
    {
        $cell = new DeadCell();

        $this->assertEquals(new DeadCell(), $cell->NextState(2));
    }

    /**
     * @test
     */
    public function a_alive_cellule_is_alive_if_it_has_two_neighbour_alive()
    {
        $cell = new AliveCell();

        $this->assertEquals(new AliveCell(), $cell->NextState(2));
    }

    /**
     * @test
     */
    public function a_cellule_is_alive_if_it_has_three_neighbour_alive()
    {
        $cell = new DeadCell();

        $this->assertEquals(new AliveCell(), $cell->NextState(3));
    }

    /**
     * @test
     */
    public function all_cellule_on_grid_is_default_dead()
    {
        $grid = new Grid();

        $x = new Coordinate(5);
        $y = new Coordinate(7);

        $this->assertEquals(new DeadCell(), $grid->get($x, $y));
    }

    /**
     * @test
     */
    public function a_grid_can_have_alive_cellule()
    {
        $grid = new Grid();

        $aliveCell = new AliveCell();
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(1));

        $this->assertEquals($aliveCell, $grid->get(new Coordinate(1), new Coordinate(1)));
    }

    /**
     * @test
     */
    public function a_new_turn_on_grid_have_a_new_cells_state()
    {
        $grid = new Grid();

        $aliveCell = new AliveCell();
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(1));
        $grid->nextRound();

        $this->assertEquals(new DeadCell(), $grid->get(new Coordinate(1), new Coordinate(1)));
    }

    /**
     * @test
     */
    public function add_multiple_cell_on_grid()
    {
        $grid = new Grid();

        $aliveCell = new AliveCell();
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(1));
        $grid->add($aliveCell, new Coordinate(2), new Coordinate(1));
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(2));
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(3));
        $grid->add($aliveCell, new Coordinate(1), new Coordinate(10));
        $grid->nextRound();

        $this->assertEquals(new AliveCell(), $grid->get(new Coordinate(1), new Coordinate(1)));
        $this->assertEquals(new DeadCell(), $grid->get(new Coordinate(1), new Coordinate(10)));
    }

}