<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\TaskInterface;
use App\Interfaces\TaskTypeInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $task;
    private $taskType;
    private $employee;

    public function __construct(TaskInterface $task, TaskTypeInterface $taskType, EmployeeInterface $employee)
    {
        $this->task = $task;
        $this->taskType = $taskType;
        $this->employee = $employee;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->task->getAll()->where('user_id', auth()->user()->id))
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('task_type', function ($data) {
                    return $data->task_type->name;
                })
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('due_date', function ($data) {
                    return date('d-m-Y', strtotime($data->due_date)) .
                        ' • ' .
                        Carbon::parse($data->due_date)
                            ->locale('id')
                            ->diffForHumans();
                })
                ->addColumn('status', function ($data) {
                    switch ($data->status) {
                        case 0:
                            return 'Menunggu';
                        case 1:
                            return 'Dikerjakan';
                        case 2:
                            return 'Selesai';
                        case 3:
                            return 'Ditolak';
                        default:
                            return 'Unknown status';
                    }
                })
                ->addColumn('description', function ($data) {
                    return view('user.task.column.description', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('user.task.column.action', compact('data'));
                })
                ->addColumn('price', function ($data) {
                    return $data->price;
                })
                ->addColumn('total_price', function ($data) {
                    return $data->total_price;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.task.index');
    }

    public function create()
    {
        return view('user.task.create', [
            'taskTypes' => $this->taskType->getAll(),
            'employees' => $this->employee->getAll(),
        ]);
    }

    public function edit($id)
    {
        return view('user.task.edit', [
            'task' => $this->task->getById($id),
            'taskTypes' => $this->taskType->getAll(),
            'employees' => $this->employee->getAll(),
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        try {
            $task = $this->task->getById($id);

            $task->update([
                'status' => $request->input('status'),
            ]);
            return redirect()
                ->route('user.task.index')
                ->with('success', 'Tugas berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()
                ->route('user.task.index')
                ->with('error', 'Tugas gagal diperbarui');
        }
    }
}
