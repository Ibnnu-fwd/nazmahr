<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CasbonInterface;
use App\Interfaces\EmployeeInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CasbonController extends Controller
{
    private $casbon;
    private $employee;

    public function __construct(CasbonInterface $casbon, EmployeeInterface $employee)
    {
        $this->casbon   = $casbon;
        $this->employee = $employee;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->casbon->getAll())
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('tenor', function ($data) {
                    $application_date = date('d-m-Y', strtotime($data->date));
                    $created_at       = date('d-m-Y', strtotime($data->created_at));
                    $diff             = Carbon::parse($created_at)->diffInDays(Carbon::parse($application_date));
                    return $application_date . ' (' . $diff . ' hari)';
                })
                ->addColumn('nominal', function ($data) {
                    return 'Rp. ' . number_format($data->nominal, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('refund_attachment', function ($data) {
                    return view('admin.casbon.column.attachment', ['data' => $data, 'type' => 'refund']);
                })
                ->addColumn('application_attachment', function ($data) {
                    return view('admin.casbon.column.attachment', ['data' => $data, 'type' => 'application']);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.casbon.column.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.casbon.index');
    }

    public function create()
    {
        return view('admin.casbon.create', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'                => 'required',
            'date'                   => 'required',
            'nominal'                => 'required',
            'refund_attachment'      => 'nullable',
            'application_attachment' => 'nullable',
            'status'                 => 'nullable',
            'description'            => 'nullable'
        ]);

        try {
            $this->casbon->store($request->all());
            return redirect()->route('admin.casbon.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.casbon.index')->with('error', 'Data gagal disimpan');
        }
    }

    public function edit($id)
    {
        return view('admin.casbon.edit', [
            'casbon'    => $this->casbon->getById($id),
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'                => 'required',
            'date'                   => 'required',
            'nominal'                => 'required',
            'refund_attachment'      => 'nullable',
            'application_attachment' => 'nullable',
            'status'                 => 'nullable',
            'description'            => 'nullable'
        ]);

        try {
            $this->casbon->update($id, $request->all());
            return redirect()->route('admin.casbon.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.casbon.index')->with('error', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->casbon->destroy($id);
        return response()->json(true);
    }
}
