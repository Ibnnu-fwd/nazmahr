<?php

namespace App\Repositories;

use App\Interfaces\AttendanceInterface;
use App\Models\Attendance;
use App\Models\AttendanceTimeConfig;
use App\Models\AttendanceType;

class AttendanceRepository implements AttendanceInterface
{
    private $attendance;
    private $attendanceType;
    private $attendanceTimeConfig;

    public function __construct(Attendance $attendance, AttendanceType $attendanceType, AttendanceTimeConfig $attendanceTimeConfig)
    {
        $this->attendance           = $attendance;
        $this->attendanceType       = $attendanceType;
        $this->attendanceTimeConfig = $attendanceTimeConfig;
    }

    public function getAll()
    {
        return $this->attendance->with(['attendanceType', 'user', 'attendanceTimeConfig'])->get();
    }

    public function getById($id)
    {
        return $this->attendance->with(['attendanceType', 'user', 'attendanceTimeConfig'])->find($id);
    }

    public function store($data)
    {
        $day                               = $this->translateDay(date('l', strtotime($data['entry_at'])));
        $attendanceTimeConfig              = $this->attendanceTimeConfig->where('day', $day)->first();
        $data['attendance_time_config_id'] = $attendanceTimeConfig['id'];
        $data['attendance_type_id']        = $attendanceTimeConfig['attendance_type_id'];
        $data['status']                    = 1;

        return $this->attendance->create($data);
    }

    public function update($id, $data)
    {
        return $this->attendance->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->attendance->find($id)->delete();
    }

    public function translateDay($day)
    {
        switch ($day) {
            case 'Sunday':
                return 'Minggu';
                break;
            case 'Monday':
                return 'Senin';
                break;
            case 'Tuesday':
                return 'Selasa';
                break;
            case 'Wednesday':
                return 'Rabu';
                break;
            case 'Thursday':
                return 'Kamis';
                break;
            case 'Friday':
                return 'Jumat';
                break;
            case 'Saturday':
                return 'Sabtu';
                break;
            default:
                return null;
                break;
        }
    }
}
