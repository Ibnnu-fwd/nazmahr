<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\RequestReimbursementInterface;
use App\Interfaces\EmployeeInterface;


class RequestReimbursementController extends Controller
{
    private $requestReimbursement;
    private $employee;



    public function __construct(RequestReimbursementInterface $requestReimbursement, EmployeeInterface $employee)
    {
        $this->requestReimbursement = $requestReimbursement;
        $this->employee          = $employee;
    }

    //function index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->requestReimbursement->getAll())
                ->addColumn('title', function ($data) {
                    return $data->title;
                })
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('date', function ($data) {
                    return date('d-m-Y', strtotime($data->date));
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('nominal', function ($data) {
                    return 'Rp' . number_format($data->nominal, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return $data->getStatus($data->status);
                })
                ->addColumn('bill_attachment', function ($data) {
                    return view('admin.request_reimbursement.column.attachment', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.request_reimbursement.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.request_reimbursement.index');
    }

    //function create
    public function create()
    {
        return view('admin.request_reimbursement.create', [
            'employees'       => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    //function store
    public function store(Request $request)
    {
        $request->validate([
            'user_id'            => 'required',
            'title' => 'required',
            'date'           => 'required',
            'description'        => 'required',
            'nominal'            => 'required',
            'status'        => 'required',
            'bill_attachment' => 'required'
        ]);
        try {
            $this->requestReimbursement->store($request->all());
            return redirect()->route('admin.request-reimbursement.index')->with('success', 'Permintaan Kehadiran berhasil ditambahkan');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.request-reimbursement.index')->with('error', 'Permintaan Kehadiran gagal ditambahkan');
        }
    }


    //function edit
    public function edit($id)
    {
        return view('admin.request_reimbursement.edit', [
            'requestReimbursement' => $this->requestReimbursement->getById($id),
            'employees'         => $this->employee->getAll()->where('position_id', '!=', 1)
        ]);
    }

    //function update
    public function update($id, Request $request)
    {
        $request->validate([
            'user_id'            => 'required',
            'title' => 'required',
            'date'           => 'required',
            'description'        => 'required',
            'nominal'            => 'required',
            'status'        => 'required',
            'bill_attachment' => 'nullable'
        ]);

        try {
            $this->requestReimbursement->update($id, $request->all());
            return redirect()->route('admin.request-reimbursement.index')->with('success', 'Permintaan Kehadiran berhasil diubah');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('admin.request-reimbursement.index')->with('error', 'Permintaan Kehadiran gagal diubah');
        }
    }

    //function destroy
    public function destroy($id)
    {
        $this->requestReimbursement->destroy($id);
        return response()->json(true);
    }
}
