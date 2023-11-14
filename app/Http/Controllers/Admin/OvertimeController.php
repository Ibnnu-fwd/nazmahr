<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\OvertimeInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    private $employee;
    private $overtime;

    public function __construct(EmployeeInterface $employee, OvertimeInterface $overtime)
    {
        $this->employee = $employee;
        $this->overtime = $overtime;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->overtime->getAll())
                ->addColumn('name', function ($data) {
                    return $data->user->name ?? '-';
                })
                ->addColumn('duration', function ($data) {
                    return $this->calculateTimeDifference($data->duration);
                })
                ->addColumn('start_at', function ($data) {
                    return $data->start_at ?? '-';
                })
                ->addColumn('end_at', function ($data) {
                    return $data->end_at ?? '-';
                })
                ->addColumn('attachment', function ($data) {
                    return view('admin.overtime.column.attachment', compact('data'));
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.overtime.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.overtime.index', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function create()
    {
        return view('admin.overtime.create', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required',
            // 'duration'   => 'nullable',
            'attachment' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'start_at'   => 'nullable',
            'end_at'     => 'nullable',
            'status'     => 'nullable'
        ]);
        try {
            $this->overtime->store($request->all());
            return redirect()->route('admin.overtime.index')->with('success', 'Lembur berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.overtime.index')->with('error', 'Lembur gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('admin.overtime.edit', [
            'overtime'  => $this->overtime->getById($id),
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'    => 'required',
            // 'duration'   => 'nullable',
            'attachment' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'start_at'   => 'nullable',
            'end_at'     => 'nullable',
            'status'     => 'nullable'
        ]);

        try {
            $this->overtime->update($id, $request->all());
            return redirect()->route('admin.overtime.index')->with('success', 'Lembur berhasil diubah');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.overtime.index')->with('error', 'Lembur gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->overtime->destroy($id);
        return response()->json(true);
    }

    function calculateTimeDifference($durationInMinutes)
    {
        $hours   = floor($durationInMinutes / 60);
        $minutes = $durationInMinutes % 60;

        if ($hours == 0) {
            return $minutes . ' m';
        } else {
            return $hours . ' j ' . $minutes . ' m';
        }
    }
}
