<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\AttendanceTypeInterface;

class AttendanceTypeController extends Controller
{
    private $attendanceType;

    public function __construct(AttendanceTypeInterface $attendanceType)
    {
        $this->attendanceType = $attendanceType;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->attendanceType->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.attendance_type.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.attendance_type.index');
    }

    public function create()
    {
        return view('admin.attendance_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|unique:attendance_types,name',
        ]);

        try {
            $this->attendanceType->store($request->all());
            return redirect()->route('admin.attendance-type.index')->with('success', 'Jenis Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('admin.attendance-type.index')->with('error', 'Jenis Kehadiran gagal ditambahkan');
        }
    }
}
