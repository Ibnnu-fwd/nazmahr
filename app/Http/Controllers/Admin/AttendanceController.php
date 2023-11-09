<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceInterface;
use App\Interfaces\AttendanceTimeConfigInterface;
use App\Interfaces\AttendanceTypeInterface;
use App\Interfaces\EmployeeInterface;
use Carbon\Carbon;
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
        $results = $this->attendance->getAll();

        if ($request->ajax()) {
            return datatables()
                ->of($results)
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('type', function ($data) {
                    return $data->attendanceType->name;
                })
                ->addColumn('date', function ($data) {
                    return date('d-m-Y', strtotime($data->entry_at));
                })
                ->addColumn('schedule_in', function ($data) {
                    return date('H:i', strtotime($data->attendanceTimeConfig->start_time));
                })
                ->addColumn('schedule_out', function ($data) {
                    return date('H:i', strtotime($data->attendanceTimeConfig->end_time));
                })
                ->addColumn('check_in', function ($data) {
                    return date('H:i', strtotime($data->entry_at));
                })
                ->addColumn('check_out', function ($data) {
                    return date('H:i', strtotime($data->exit_at));
                })
                ->addColumn('late_time', function ($data) {
                    return $this->calculateTimeDifference($data->attendanceTimeConfig->start_time, $data->entry_at);
                })
                ->addColumn('overtime', function ($data) {
                    return $this->calculateTimeDifference($data->attendanceTimeConfig->end_time, $data->exit_at);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.attendance.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.attendance.index', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
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
        ]);

        try {
            $this->attendance->update($id, $request->all());
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

    public function liveAttendance()
    {
        $attendanceTimeConfig = $this->attendanceTimeConfig->getByDay(Carbon::now()->locale('id')->dayName);
        $attendance           = $this->attendance->getByUserIdAndDate(auth()->user()->id, Carbon::now()->format('Y-m-d'));

        return view('admin.attendance.live', [
            'attendanceTimeConfig' => $attendanceTimeConfig,
            'attendance'          => $attendance
        ]);
    }

    public function clockIn(Request $request)
    {
        $attendanceTimeConfig = $this->attendanceTimeConfig->getByDay(Carbon::now()->locale('id')->dayName);
        try {
            $this->attendance->clockIn($attendanceTimeConfig, $request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Anda berhasil melakukan absensi masuk'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function clockOut(Request $request)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $attendanceTimeConfig = $this->attendanceTimeConfig->getByDay(Carbon::now()->locale('id')->dayName);
        try {
            $this->attendance->clockOut($attendanceTimeConfig, $request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Anda berhasil melakukan absensi keluar'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        return view('admin.attendance.show', [
            'attendance' => $this->attendance->getById($id)
        ]);
    }

    // CUSTOM FUNCTION

    function calculateTimeDifference($startTime, $endTime)
    {
        $startTime = date('H:i:s', strtotime($startTime));
        $endTime   = date('H:i:s', strtotime($endTime));

        if (strtotime($endTime) > strtotime($startTime)) {
            $timeDifference = Carbon::parse($endTime)->diffInSeconds(Carbon::parse($startTime));
        } else {
            return '-';
        }

        $hours   = floor($timeDifference / 3600);
        $minutes = floor(($timeDifference / 60) % 60);

        return $hours . ' J ' . $minutes . ' M';
    }
}
