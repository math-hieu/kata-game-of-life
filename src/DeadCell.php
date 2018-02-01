<?php


namespace GameOfLife;


final class DeadCell extends Cell
{
    public function isAlive()
    {
        return false;
    }
}