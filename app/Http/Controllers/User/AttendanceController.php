<?php

namespace App\Http\Controllers\User;

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
        if ($request->ajax()) {
            return datatables()
                ->of($this->attendance->getAll()->where('user_id', auth()->user()->id))
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
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.attendance.index', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function create()
    {
        return view('user.attendance.create', [
            'employees'             => $this->employee->getAll()->where('position_id', '!=', 1),
            'attendanceTimeConfigs' => $this->attendanceTimeConfig->getAll(),
            'attendanceTypes'       => $this->attendanceType->getAll()
        ]);
    }

    public function liveAttendance()
    {
        $attendanceTimeConfig = $this->attendanceTimeConfig->getByDay(Carbon::now()->locale('id')->dayName);
        $attendance           = $this->attendance->getByUserIdAndDate(auth()->user()->id, Carbon::now()->format('Y-m-d'));

        return view('user.attendance.live', [
            'attendanceTimeConfig' => $attendanceTimeConfig,
            'attendance'          => $attendance
        ]);
    }

    public function clockIn()
    {
        $attendanceTimeConfig = $this->attendanceTimeConfig->getByDay(Carbon::now()->locale('id')->dayName);
        try {
            $this->attendance->clockIn($attendanceTimeConfig);
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
            $this->attendance->clockOut($attendanceTimeConfig, $request->description);
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

        return $hours . ' jam ' . $minutes . ' menit';
    }
}

