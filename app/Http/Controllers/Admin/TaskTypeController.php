<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TaskTypeInterface;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{
    private $taskType;

    public function __construct(TaskTypeInterface $taskType)
    {
        $this->taskType = $taskType;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->taskType->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('priority', function ($data) {
                    $priorityTranslations = [
                        'normal' => 'normal',
                        'low'    => 'rendah',
                        'medium' => 'sedang',
                        'high'   => 'tinggi',
                    ];

                    $priority = $data->priority;
                    $priority = $priorityTranslations[$priority] ?? $priority;

                    return strtoupper($priority);
                })
                ->addColumn('price', function ($data) {
                    return $data->price ? 'Rp.' . number_format($data->price, 0, ',', '.') : '-';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.task_type.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.task_type.index');
    }

    public function create()
    {
        return view('admin.task_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|unique:task_types,name',
            'priority' => 'required',
            'price'    => 'nullable'
        ]);

        try {
            $this->taskType->store($request->all());
            return redirect()->route('admin.task-type.index')->with('success', 'Tipe tugas berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.task-type.index')->with('error', 'Tipe tugas gagal ditambahkan');
        }
    }

    public function edit($id, Request $request)
    {
        return view('admin.task_type.edit', [
            'taskType' => $this->taskType->getById($id)
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name'     => 'required|unique:task_types,name,' . $id,
            'priority' => 'required',
            'price'    => 'nullable'
        ]);

        try {
            $this->taskType->update($id, $request->all());
            return redirect()->route('admin.task-type.index')->with('success', 'Tipe tugas berhasil diubah');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.task-type.index')->with('error', 'Tipe tugas gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->taskType->destroy($id);
        return response()->json(true);
    }
}
