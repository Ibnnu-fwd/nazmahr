<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceTimeConfigInterface;
use Illuminate\Http\Request;

class AttendanceTimeConfigController extends Controller
{
    private $attendanceTimeConfig;

    public function __construct(AttendanceTimeConfigInterface $attendanceTimeConfig)
    {
        $this->attendanceTimeConfig = $attendanceTimeConfig;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->attendanceTimeConfig->getAll())
                ->addColumn('day', function ($data) {
                    return $data->day;
                })
                ->addColumn('start_time', function ($data) {
                    return date('H:i', strtotime($data->start_time)) . ' WIB';
                })
                ->addColumn('end_time', function ($data) {
                    return date('H:i', strtotime($data->end_time)) . ' WIB';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.attendance_time_config.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.attendance_time_config.index');
    }

    public function create()
    {
        return view('admin.attendance_time_config.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day'        => ['required', 'unique:attendance_time_configs,day'],
            'start_time' => ['required'],
            'end_time'   => ['required'],
        ]);

        try {
            $this->attendanceTimeConfig->store($request->all());
            return redirect()->route('admin.attendance-time-config.index')->with('success', 'Konfigurasi waktu kehadiran berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.attendance-time-config.index')->with('error', 'Konfigurasi waktu kehadiran gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('admin.attendance_time_config.edit', ['attendanceTimeConfig' => $this->attendanceTimeConfig->getById($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'day'        => ['required', 'unique:attendance_time_configs,day,' . $id],
            'start_time' => ['required'],
            'end_time'   => ['required'],
        ]);

        try {
            $this->attendanceTimeConfig->update($id, $request->all());
            return redirect()->route('admin.attendance-time-config.index')->with('success', 'Konfigurasi waktu kehadiran berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.attendance-time-config.index')->with('error', 'Konfigurasi waktu kehadiran gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $this->attendanceTimeConfig->destroy($id);
        return response()->json(true);
    }
}
