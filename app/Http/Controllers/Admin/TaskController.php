<?php

namespace App\Http\Controllers\Admin;

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
        $this->task     = $task;
        $this->taskType = $taskType;
        $this->employee = $employee;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->task->getAll())
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
                    return date('d-m-Y', strtotime($data->due_date)) . ' • ' . Carbon::parse($data->due_date)->locale('id')->diffForHumans();
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
                    return view('admin.task.column.description', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.task.column.action', compact('data'));
                })
                ->addColumn('price', function ($data) {
                    return 'Rp ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('total_price', function ($data) {
                    return 'Rp ' . number_format($data->total_price, 0, ',', '.');
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.task.index');
    }

    public function create()
    {
        return view('admin.task.create', [
            'taskTypes' => $this->taskType->getAll(),
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_type_id' => 'required',
            'title'        => 'required',
            'user_id'      => 'required',
            'due_date'     => 'nullable',
            'description'  => 'nullable',
            'status'       => 'required',
            'price'        => 'required',
            'total_price'  => 'nullable',
        ]);

        try {
            $this->task->store($request->all());
            return redirect()->route('admin.task.index')->with('success', 'Tugas berhasil dibuat');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.task.index')->with('error', 'Tugas gagal dibuat');
        }
    }

    public function edit($id)
    {
        return view('admin.task.edit', [
            'task'       => $this->task->getById($id),
            'taskTypes'  => $this->taskType->getAll(),
            'employees'  => $this->employee->getAll(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_type_id' => 'required',
            'title'        => 'required',
            'user_id'      => 'required',
            'due_date'     => 'nullable',
            'description'  => 'nullable',
            'status'       => 'required',
            'price'        => 'required',
            'total_price'  => 'nullable',
        ]);

        try {
            $this->task->update($id, $request->all());
            return redirect()->route('admin.task.index')->with('success', 'Tugas berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.task.index')->with('error', 'Tugas gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $this->task->destroy($id);
        return response()->json(true);
    }

    public function show($id)
    {
        return view('admin.task.show', [
            'task' => $this->task->getById($id)
        ]);
    }

    public function changeStatus($id, Request $request)
    {
        $this->task->changeStatus($id, $request->status);
        return response()->json(true);
    }
}
