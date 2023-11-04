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

    public function getById($id)
    {
        return $this->position->find($id);
    }

    public function store($data)
    {
        return $this->position->create($data);
    }

    public function update($id, $data)
    {
        return $this->position->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->position->find($id)->delete();
    }
}
