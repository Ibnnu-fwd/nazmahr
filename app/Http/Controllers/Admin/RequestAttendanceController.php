<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RequestAttendanceInterface;
use App\Interfaces\AttendanceTypeInterface;
use App\Interfaces\EmployeeInterface;


class RequestAttendanceController extends Controller
{
    private $requestAttendance;
    private $attendanceType;
    private $employee;



    public function __construct(RequestAttendanceInterface $requestAttendance, AttendanceTypeInterface $attendanceType, EmployeeInterface $employee)
    {
        $this->requestAttendance = $requestAttendance;
        $this->attendanceType = $attendanceType;
        $this->employee = $employee;
    }

    //function index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->requestAttendance->getAll())
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('date', function ($data) {
                    return date('d-m-Y', strtotime($data->created_at));
                })
                ->addColumn('attendance_type', function ($data) {
                    return $data->attendanceType->name;
                })
                ->addColumn('entry_at', function ($data) {
                    return date('H:i', strtotime($data->entry_at)) . ' WIB';
                })
                ->addColumn('exit_at', function ($data) {
                    return date('H:i', strtotime($data->exit_at)) . ' WIB';
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('status_verification', function ($data) {
                    return $data->status_verification;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.request_attendance.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.request_attendance.index');
    }

    //function create
    public function create()
    {   
        return view('admin.request_attendance.create', [
            'attendanceTypes' => $this->requestAttendance->getAttendanceTypes(),
            'employees' => $this->employee->getAll(),
        ]);
    }

    //function store
    public function store(Request $request)
    {
        $request->validate([
            'user_id'      => 'required',
            'attendance_type_id' => 'required',
            'entry_at' => 'required',
            'exit_at' => 'required',
            'description' => 'required',
        ]); 
        try {
            $this->requestAttendance->store($request->all());
            return redirect()->route('admin.request-attendance.index')->with('success', 'Permintaan Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.request-attendance.index')->with('error', 'Permintaan Kehadiran gagal ditambahkan');
        }
    }


    //function edit
    public function edit($id, Request $request)
    {
        return view('admin.request_attendance.edit', [
            'requestAttendance' => $this->requestAttendance->getById($id),
            'attendanceTypes' => $this->requestAttendance->getAttendanceTypes(),
            'employees' => $this->employee->getAll(),
        ]);
    }

    //function update
    public function update($id, Request $request)
    {
        $request->validate([
            'user_id'      => 'required',
            'attendance_type_id' => 'required',
            'entry_at' => 'required',
            'exit_at' => 'required',
            'description' => 'required',
        ]);

        try {
            $this->requestAttendance->update($id, $request->all());
            return redirect()->route('admin.request-attendance.index')->with('success', 'Permintaan Kehadiran berhasil diubah');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.request-attendance.index')->with('error', 'Permintaan Kehadiran gagal diubah');
        }
    }

    //function destroy
    public function destroy($id)
    {
        $this->requestAttendance->destroy($id);
        return response()->json(true);
    }
}
