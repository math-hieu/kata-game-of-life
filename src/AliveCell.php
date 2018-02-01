<?php


namespace GameOfLife;


final class AliveCell extends Cell
{
    public function isAlive()
    {
        return true;
    }
}