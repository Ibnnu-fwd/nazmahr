<?php

namespace App\Repositories;

use App\Interfaces\PositionInterface;
use App\Models\Positition;

class PositionRepository implements PositionInterface
{
    private $position;

    public function __construct(Positition $position)
    {
        $this->position = $position;
    }

    public function getAll()
    {
        return $this->position->all();
    }
}
