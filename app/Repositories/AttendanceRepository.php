<?php

namespace App\Repositories;

use App\Interfaces\AttendanceInterface;
use App\Models\Attendance;
use App\Models\AttendanceTimeConfig;
use App\Models\AttendanceType;
use App\Models\CompanyConfigurationSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceRepository implements AttendanceInterface
{
    private $attendance;
    private $attendanceType;
    private $attendanceTimeConfig;
    private $companyConfigurationSetting;

    public function __construct(Attendance $attendance, AttendanceType $attendanceType, AttendanceTimeConfig $attendanceTimeConfig, CompanyConfigurationSetting $companyConfigurationSetting)
    {
        $this->attendance                  = $attendance;
        $this->attendanceType              = $attendanceType;
        $this->attendanceTimeConfig        = $attendanceTimeConfig;
        $this->companyConfigurationSetting = $companyConfigurationSetting;
    }

    public function getAll()
    {
        $result = $this->attendance
            ->with(['attendanceType', 'user', 'attendanceTimeConfig'])
            ->orderBy('entry_at', 'desc')
            ->get();

        if (isset(request()->date)) {
            $result = $this->attendance
                ->with(['attendanceType', 'user', 'attendanceTimeConfig'])
                ->whereDate('entry_at', request()->date)
                ->orderBy('entry_at', 'desc')
                ->get();
        }

        if (isset(request()->employee_id)) {
            $result = $this->attendance
                ->with(['attendanceType', 'user', 'attendanceTimeConfig'])
                ->where('user_id', request()->employee_id == 'all' ? '!=' : '=', request()->employee_id)
                ->orderBy('entry_at', 'desc')
                ->get();
        }

        return $result;
    }

    public function getRecap()
    {
        $companyConfigurationSetting = $this->companyConfigurationSetting->first();
        $toranceLateTimeInMinutes    = $companyConfigurationSetting->tolerance_late_time_in_minutes;
        $month = Carbon::parse(request()->date)->format('m/Y');
        $user_id = request()->user_id;

        $result = $this->attendance
            ->with(['attendanceType', 'user', 'attendanceTimeConfig'])
            ->whereMonth('entry_at', $month)
            ->where('user_id', $user_id)
            ->orderBy('entry_at', 'desc')
            ->get();

        // set late time and overtime
        foreach ($result as $attendance) {
            $attendance->late_time = $this->calculateLateTime($attendance->attendanceTimeConfig->start_time, $attendance->entry_at, $toranceLateTimeInMinutes);
            $attendance->overtime  = $this->calculateTimeDifference($attendance->attendanceTimeConfig->end_time, $attendance->exit_at);
        }

        $dates = [];
        for ($i = 1; $i <= Carbon::parse(request()->date)->daysInMonth; $i++) {
            $dates[] = date('d-m-Y', strtotime(request()->date . '-' . $i));
        }

        $attendances = [];
        foreach ($dates as $index => $date) {
            foreach ($result as $attendance) {
                if (date('d-m-Y', strtotime($attendance->entry_at)) == $date) {
                    $attendances[$index + 1] = $attendance;
                    break;
                } else {
                    $attendances[$index + 1] = null;
                }
            }
        }

        $attendances = array_combine($dates, $attendances);
        return $attendances;
    }

    function calculateLateTime($startTime, $entryAt, $toranceLateTimeInMinutes)
    {
        $startTime = date('H:i:s', strtotime($startTime));
        $entryAt   = date('H:i:s', strtotime($entryAt));

        if (strtotime($entryAt) > strtotime($startTime)) {
            $lateTime = Carbon::parse($entryAt)->diffInSeconds(Carbon::parse($startTime));
        } else {
            return '-';
        }

        $minutes = floor($lateTime / 60); // Corrected this line

        if ($minutes > $toranceLateTimeInMinutes) {
            return ($minutes - $toranceLateTimeInMinutes) . ' m';
        } else {
            return '-';
        }
    }

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

        if ($hours == 0) {
            return $minutes . ' m';
        } else {
            return $hours . ' j ' . $minutes . ' m';
        }
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

    public function clockIn($attendanceTimeConfig, $data)
    {
        $attendance = $this->attendance->where([
            ['user_id', auth()->user()->id],
            ['attendance_time_config_id', $attendanceTimeConfig->id],
            ['entry_at', '>=', Carbon::now()->startOfDay()],
            ['entry_at', '<=', Carbon::now()->endOfDay()]
        ])->first();


        DB::beginTransaction();
        if ($attendance != null) {
            throw new \Exception('Anda sudah melakukan absensi pada hari ini');
        }
        try {
            $this->attendance->create([
                'user_id'                   => auth()->user()->id,
                'attendance_time_config_id' => $attendanceTimeConfig->id,
                'attendance_type_id'        => $attendanceTimeConfig->attendance_type_id,
                'entry_at'                  => Carbon::now()->timezone('Asia/Jakarta'),
                'location'                  => $data['location']  ?? null,
                'latitude'                  => $data['latitude']  ?? null,
                'longitude'                 => $data['longitude'] ?? null,
                'status'                    => 1
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollback();
            throw $th;
        }
    }

    public function clockOut($attendanceTimeConfig, $data)
    {
        $attendance = $this->attendance->where([
            ['user_id', auth()->user()->id],
            ['attendance_time_config_id', $attendanceTimeConfig->id],
            ['entry_at', '>=', Carbon::now()->startOfDay()],
            ['entry_at', '<=', Carbon::now()->endOfDay()]
        ])->first();

        DB::beginTransaction();
        if ($attendance == null) {
            throw new \Exception('Anda belum melakukan absensi masuk pada hari ini');
        }
        try {
            $attendance->update([
                'exit_at'     => Carbon::now()->timezone('Asia/Jakarta'),
                'description' => $data['description'] ?? null,
                'latitude'    => $data['latitude']    ?? null,
                'longitude'   => $data['longitude']   ?? null,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function getByUserIdAndDate($userId, $date)
    {
        return $this->attendance->where([
            ['user_id', $userId],
            ['entry_at', '>=', $date . ' 00:00:00'],
            ['entry_at', '<=', $date . ' 23:59:59']
        ])->first();
    }
}
