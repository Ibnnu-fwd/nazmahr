<?php

namespace App\Repositories;

use App\Interfaces\RequestAttendanceInterface;
use App\Models\RequestAttendance;
use App\Models\AttendanceType;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;

class RequestAttendanceRepository implements RequestAttendanceInterface
{
    private $requestAttendance;
    private $attendance;

    public function __construct(RequestAttendance $requestAttendance, Attendance $attendance)
    {
        $this->requestAttendance = $requestAttendance;
        $this->attendance = $attendance;
    }

    public function getAll()
    {
        return $this->requestAttendance->with(['attendanceType', 'user'])->get();
    }

    public function getById($id)
    {
        return $this->requestAttendance->with(['attendanceType', 'user'])->find($id);
    }

    public function store($data)
    {
        return $this->requestAttendance->create($data);
    }

    public function updateAdmin($id, $data)
    {
        if ($data['status_verification'] == strtolower(RequestAttendance::STATUS_CONFIRMED)) {
            DB::beginTransaction();

            try {
                $requestAttendance = $this->requestAttendance->find($id);
                $requestAttendance->updateAdmin($data);
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }

            try {
                $this->attendance->create([
                    'attendance_type_id' => $requestAttendance->attendance_type_id,
                    'attendance_time_config_id' => $requestAttendance->attendance_time_config_id,
                    'user_id' => $requestAttendance->user_id,
                    'entry_at' => $requestAttendance->entry_at,
                    'exit_at' => $requestAttendance->exit_at,
                    'description' => $requestAttendance->description,
                    'status' => 1,
                    'created_by' => $requestAttendance->created_by,
                ]);
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }

            DB::commit();
        } else {
            return $this->requestAttendance->find($id)->update($data);
        }
    }

    public function update($id, $data)
    {
        return $this->requestAttendance->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->requestAttendance->find($id)->delete();
    }

    public function getAttendanceTypes()
    {
        return AttendanceType::all();
    }
}
