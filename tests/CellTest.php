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
        $grid = new Grid([]);

        $this->assertEquals(new DeadCell(), $grid->get(5, 7));
    }

    /**
     * @test
     */
    public function a_grid_can_have_alive_cellule()
    {
        $gridBuilder = new GridBuilder();

        $gridBuilder->addAliveCell(1, 1);
        $grid = $gridBuilder->build();

        $this->assertEquals(new AliveCell(), $grid->get(1, 1));
    }

    /**
     * @test
     */
    public function a_new_turn_on_grid_have_a_new_cells_state()
    {
        $gridBuilder = new GridBuilder();

        $gridBuilder->addAliveCell(1, 1);
        $grid = $gridBuilder->build();
        $grid = $grid->nextRound();

        $this->assertEquals(new DeadCell(), $grid->get(1,  1));
    }

    /**
     * @test
     */
    public function add_multiple_cell_on_grid()
    {
        $gridBuilder = new GridBuilder();

        $gridBuilder->addAliveCell(1, 1);
        $gridBuilder->addAliveCell(1, 2);
        $gridBuilder->addAliveCell(1, 3);
        $gridBuilder->addAliveCell(1, 10);
        $gridBuilder->addAliveCell(2, 1);
        $grid = $gridBuilder->build();
        $grid = $grid->nextRound();

        $this->assertEquals(new AliveCell(), $grid->get(1, 1));
        $this->assertEquals(new DeadCell(), $grid->get(1, 10));
    }

}