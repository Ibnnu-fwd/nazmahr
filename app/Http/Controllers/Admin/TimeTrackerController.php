<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\TimeTrackerInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeTrackerController extends Controller
{
    private $timeTracker;
    private $employee;

    public function __construct(TimeTrackerInterface $timeTracker, EmployeeInterface $employee)
    {
        $this->timeTracker = $timeTracker;
        $this->employee    = $employee;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->timeTracker->getAll())
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('subject', function ($data) {
                    return $data->subject;
                })
                ->addColumn('start_time', function ($data) {
                    return $data->start_time ? date('H:i', strtotime($data->start_time)) : '-';
                })
                ->addColumn('end_time', function ($data) {
                    return $data->end_time ? date('H:i', strtotime($data->end_time)) : '-';
                })
                ->addColumn('total_time', function ($data) {
                    return $data->end_time ? Carbon::parse($data->start_time)->diff(Carbon::parse($data->end_time))->format('%h jam %i menit') : '-';
                })
                ->addColumn('task', function ($data) {
                    return $data->task ?? '-';
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('created_at', function ($data) {
                    return date('d-m-Y', strtotime($data->created_at));
                })
                ->addColumn('button', function ($data) {
                    return view('admin.time_tracker.column.button', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.time_tracker.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.time_tracker.index');
    }

    public function create()
    {
        $employees = $this->employee->getAll()->where('position_id', '!=', 1);
        return view('admin.time_tracker.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required',
            'subject'    => 'required',
            'task'       => 'nullable',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);

        try {
            $this->timeTracker->store($request->except('_token'));
            return redirect()->route('admin.time-tracker.index')->with('success', 'Traker berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.time-tracker.index')->with('error', 'Traker gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $timeTracker = $this->timeTracker->getById($id);
        $employees   = $this->employee->getAll();
        return view('admin.time_tracker.edit', compact('timeTracker', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'    => 'required',
            'subject'    => 'required',
            'task'       => 'nullable',
            'start_time' => 'nullable',
            'end_time'   => 'nullable',
        ]);

        try {
            $this->timeTracker->update($id, $request->except('_token'));
            return redirect()->route('admin.time-tracker.index')->with('success', 'Traker berhasil diupdate');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.time-tracker.index')->with('error', 'Traker gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $this->timeTracker->destroy($id);
        return response()->json(true);
    }

    public function start($id)
    {
        $this->timeTracker->start($id);
        return response()->json(true);
    }

    public function stop($id)
    {
        $this->timeTracker->stop($id);
        return response()->json(true);
    }

    public function continue($id)
    {
        $this->timeTracker->continue($id);
        return response()->json(true);
    }

    public function finish($id)
    {
        $this->timeTracker->finish($id);
        return response()->json(true);
    }
}
