<?php

namespace App\Repositories;

use App\Interfaces\TaskTypeInterface;
use App\Models\TaskType;

class TaskTypeRepository implements TaskTypeInterface
{
    private $taskType;

    public function __construct(TaskType $taskType)
    {
        $this->taskType = $taskType;
    }

    public function getAll()
    {
        return $this->taskType->all();
    }

    public function getById($id)
    {
        return $this->taskType->find($id);
    }

    public function store($data)
    {
        return $this->taskType->create($data);
    }

    public function update($id, $data)
    {
        return $this->taskType->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->taskType->find($id)->delete();
    }
}
