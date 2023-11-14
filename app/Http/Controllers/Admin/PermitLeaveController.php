<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\PermitLeaveInterface;
use Illuminate\Http\Request;

class PermitLeaveController extends Controller
{
    private $permitLeave;
    private $employee;

    public function __construct(PermitLeaveInterface $permitLeave, EmployeeInterface $employee)
    {
        $this->permitLeave = $permitLeave;
        $this->employee    = $employee;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->permitLeave->getAll())
                ->addColumn('employee', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('submission_type', function ($data) {
                    return $data->submission_type == 'permit' ? 'Izin' : 'Cuti';
                })
                ->addColumn('start_date', function ($data) {
                    return date('d-m-Y', strtotime($data->start_date));
                })
                ->addColumn('end_date', function ($data) {
                    return date('d-m-Y', strtotime($data->end_date));
                })
                ->addColumn('attachment', function ($data) {
                    return view('admin.permit_leave.column.attachment', compact('data'));
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.permit_leave.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.permit_leave.index');
    }

    public function create()
    {
        return view('admin.permit_leave.create', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', '1')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'         => 'required',
            'submission_type' => 'required',
            'start_date'      => 'required',
            'end_date'        => 'required',
            'attachment'      => 'nullable|mimes:pdf|max:2048',
            'status'          => 'nullable',
            'description'     => 'nullable',
        ]);


        try {
            $this->permitLeave->store($request->all());
            return redirect()->route('admin.permit-leave.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.permit-leave.index')->with('failed', 'Data gagal disimpan');
        }
    }

    public function edit($id)
    {
        return view('admin.permit_leave.edit', [
            'permitLeave' => $this->permitLeave->getById($id),
            'employees'   => $this->employee->getAll()->where('position_id', '!=', '1')
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'         => 'required',
            'submission_type' => 'required',
            'start_date'      => 'required',
            'end_date'        => 'required',
            'attachment'      => 'nullable|mimes:pdf|max:2048',
            'status'          => 'nullable',
            'description'     => 'nullable',
        ]);

        try {
            $this->permitLeave->update($id, $request->all());
            return redirect()->route('admin.permit-leave.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.permit-leave.index')->with('failed', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->permitLeave->destroy($id);
        return response()->json(true);
    }

    public function show($id)
    {
        return view('admin.permit_leave.show', [
            'permitLeave' => $this->permitLeave->getById($id)
        ]);
    }

    public function changeStatus($id, Request $request)
    {
        $this->permitLeave->changeStatus($id, $request->status);
        return response()->json(true);
    }
}
