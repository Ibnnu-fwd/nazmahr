<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceInterface;
use App\Interfaces\AttendanceTimeConfigInterface;
use App\Interfaces\AttendanceTypeInterface;
use App\Interfaces\EmployeeInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendance;
    private $employee;
    private $attendanceTimeConfig;
    private $attendanceType;

    public function __construct(AttendanceInterface $attendance, AttendanceTimeConfigInterface $attendanceTimeConfig, EmployeeInterface $employee, AttendanceTypeInterface $attendanceType)
    {
        $this->attendance           = $attendance;
        $this->attendanceTimeConfig = $attendanceTimeConfig;
        $this->employee             = $employee;
        $this->attendanceType       = $attendanceType;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->attendance->getAll())
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('type', function ($data) {
                    return $data->attendanceType->name;
                })
                ->addColumn('date', function ($data) {
                    return date('d-m-Y', strtotime($data->created_at));
                })
                ->addColumn('schedule_in', function ($data) {
                    return date('H:i', strtotime($data->attendanceTimeConfig->start_time));
                })
                ->addColumn('schedule_out', function ($data) {
                    return date('H:i', strtotime($data->attendanceTimeConfig->end_time));
                })
                ->addColumn('check_in', function ($data) {
                    return date('H:i', strtotime($data->entry_at)) . ' WIB';
                })
                ->addColumn('check_out', function ($data) {
                    return date('H:i', strtotime($data->exit_at)) . ' WIB';
                })
                ->addColumn('late_time', function ($data) {
                    $schedule_in = $data->attendanceTimeConfig->start_time;
                    $check_in    = $data->entry_at;

                    if (strtotime($check_in) > strtotime($schedule_in)) {
                        $late_time = strtotime($check_in) - strtotime($schedule_in);
                    } else return 'ONTIME';

                    return date('H', $late_time) . ' jam ' . date('i', $late_time) . ' menit';
                })
                ->addColumn('overtime', function ($data) {
                    $schedule_out = $data->attendanceTimeConfig->end_time;
                    $check_out    = $data->exit_at;

                    if (strtotime($check_out) > strtotime($schedule_out)) {
                        $overtime = strtotime($check_out) - strtotime($schedule_out);
                    } else return 'ONTIME';

                    return date('H', $overtime) . ' jam ' . date('i', $overtime) . ' menit';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.attendance.index');
    }

    public function create()
    {
        return view('admin.attendance.create', [
            'employees'             => $this->employee->getAll()->where('position_id', '!=', 1),
            'attendanceTimeConfigs' => $this->attendanceTimeConfig->getAll(),
            'attendanceTypes'       => $this->attendanceType->getAll()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required',
            'entry_at'    => 'required',
            'exit_at'     => 'required',
            'description' => 'nullable',
            'status'      => 'required',
        ]);

        try {
            $this->attendance->store($request->all());
            return redirect()->route('admin.attendance.index')->with('success', 'Kehadiran berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.attendance.index')->with('error', 'Kehadiran gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('admin.attendance.edit', [
            'attendance'            => $this->attendance->getById($id),
            'employees'             => $this->employee->getAll(),
            'attendanceTimeConfigs' => $this->attendanceTimeConfig->getAll(),
            'attendanceTypes'       => $this->attendanceType->getAll()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'     => 'required',
            'entry_at'    => 'required',
            'exit_at'     => 'required',
            'description' => 'nullable',
            'status'      => 'required',
        ]);

        try {
            $this->attendance->update($request->all(), $id);
            return redirect()->route('admin.attendance.index')->with('success', 'Kehadiran berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.attendance.index')->with('error', 'Kehadiran gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $this->attendance->destroy($id);
        return response()->json(true);
    }
}
