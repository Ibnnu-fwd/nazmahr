<?php

namespace App\Repositories;

use App\Interfaces\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getAll()
    {
        return $this->task->with('user', 'task_type')->get();
    }

    public function getById($id)
    {
        return $this->task->with('user', 'task_type')->find($id);
    }

    public function store($data)
    {
        return $this->task->create($data);
    }

    public function update($id, $data)
    {
        return $this->task->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->task->destroy($id);
    }

    public function changeStatus($id, $status)
    {
        return $this->task->find($id)->update([
            'status' => $status
        ]);
    }
}
