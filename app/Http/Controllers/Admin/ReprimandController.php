<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\ReprimandInterface;
use Illuminate\Http\Request;

class ReprimandController extends Controller
{
    private $reprimand;
    private $employee;

    public function __construct(ReprimandInterface $reprimand, EmployeeInterface $employee)
    {
        $this->reprimand = $reprimand;
        $this->employee  = $employee;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->reprimand->getAll())
                ->addColumn('user', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('reprimand_type', function ($data) {
                    return $data->reprimand_type;
                })
                ->addColumn('start_date', function ($data) {
                    return $data->start_date ? date('d-m-Y', strtotime($data->start_date)) : '-';
                })
                ->addColumn('end_date', function ($data) {
                    return $data->end_date ? date('d-m-Y', strtotime($data->end_date)) : '-';
                })
                ->addColumn('attachment', function ($data) {
                    return view('admin.reprimand.column.attachment', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.reprimand.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.reprimand.index');
    }

    public function create()
    {
        return view('admin.reprimand.create', [
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'        => 'required',
            'reprimand_type' => 'required',
            'start_date'     => 'nullable',
            'end_date'       => 'nullable',
            'content'        => 'required',
            'attachment'     => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'is_send_email'  => 'nullable',
        ]);

        try {
            $this->reprimand->store($request->all());
            return redirect()->route('admin.reprimand.index')->with('success', 'Surat Peringatan berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.reprimand.index')->with('error', 'Surat Peringatan gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        return view('admin.reprimand.edit', [
            'reprimand' => $this->reprimand->getById($id),
            'employees' => $this->employee->getAll()->where('position_id', '!=', 1),
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'user_id'        => 'required',
            'reprimand_type' => 'required',
            'start_date'     => 'nullable',
            'end_date'       => 'nullable',
            'content'        => 'required',
            'attachment'     => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'is_send_email'  => 'nullable',
        ]);

        try {
            $this->reprimand->update($id, $request->all());
            return redirect()->route('admin.reprimand.index')->with('success', 'Surat Peringatan berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.reprimand.index')->with('error', 'Surat Peringatan gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->reprimand->destroy($id);
        return response()->json(true);
    }
}
