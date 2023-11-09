<?php

namespace App\Http\Controllers\User;

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
                ->of($this->overtime->getAll()->where('user_id', auth()->user()->id))
                ->addColumn('name', function ($data) {
                    return $data->user->name ?? '-';
                })
                ->addColumn('duration', function ($data) {
                   $durationInMinutes = $data->duration;

                   $durationInHours = floor($durationInMinutes / 60);
                   $remainingMinutes = $durationInMinutes % 60;
                   
                   return $durationInHours . ' Jam ' . $remainingMinutes . ' Menit';                    
                })
                ->addColumn('start_at', function ($data) {
                    return $data->start_at ?? '-';
                })
                ->addColumn('end_at', function ($data) {
                    return $data->end_at ?? '-';
                })
                ->addColumn('attachment', function ($data) {
                    return view('user.overtime.column.attachment', compact('data'));
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('action', function ($data) {
                    return view('user.overtime.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.overtime.index', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function create()
    {
        return view('user.overtime.create', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'duration'   => 'nullable',
            'attachment' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            'start_at'   => 'nullable',
            'end_at'     => 'nullable',
            'status'     => 'nullable'
        ]);

        try {
            $this->overtime->store($request->all());
            return redirect()->route('user.overtime.index')->with('success', 'Lembur berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('user.overtime.index')->with('error', 'Lembur gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('user.overtime.edit', [
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
            return redirect()->route('user.overtime.index')->with('success', 'Lembur berhasil diubah');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('user.overtime.index')->with('error', 'Lembur gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->overtime->destroy($id);
        return response()->json(true);
    }

}