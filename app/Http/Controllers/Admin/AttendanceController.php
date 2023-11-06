<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceInterface;
use App\Interfaces\AttendanceTimeConfigInterface;
use App\Interfaces\EmployeeInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendance;
    private $employee;
    private $attendanceTimeConfig;

    public function __construct(AttendanceInterface $attendance, AttendanceTimeConfigInterface $attendanceTimeConfig, EmployeeInterface $employee)
    {
        $this->attendance = $attendance;
        $this->attendanceTimeConfig = $attendanceTimeConfig;
        $this->employee = $employee;
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
                ->addColumn('late_time', function($data) {
                    $schedule_in = $data->attendanceTimeConfig->start_time;
                    $check_in = $data->entry_at;

                    if( strtotime($check_in) > strtotime($schedule_in) ) {
                        $late_time = strtotime($check_in) - strtotime($schedule_in);
                    }
                    else return null;

                    return date('H', $late_time) . ' jam ' . date('i', $late_time) . ' menit';
                })
                ->addColumn('overtime', function($data) {
                    $schedule_out = $data->attendanceTimeConfig->end_time;
                    $check_out = $data->exit_at;

                    if(strtotime($check_out) > strtotime($schedule_out)) {
                        $overtime = strtotime($check_out) - strtotime($schedule_out);
                    }
                    else return null;

                    return date('H', $overtime) . ' jam ' . date('i', $overtime) . ' menit';
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.attendance.index');
    }
}
