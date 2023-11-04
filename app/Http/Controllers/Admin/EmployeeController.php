<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\PositionInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employee;
    private $position;

    public function __construct(EmployeeInterface $employee, PositionInterface $position)
    {
        $this->employee = $employee;
        $this->position = $position;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->employee->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('position', function ($data) {
                    return $data->position->name;
                })
                ->addColumn('gender', function ($data) {
                    return $data->gender == 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone;
                })
                ->addColumn('join_date', function ($data) {
                    return date('d-m-Y', strtotime($data->join_date));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.employee.column.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.employee.index');
    }

    public function create()
    {
        return view('admin.employee.create', [
            'positions' => $this->position->getAll()->where('name', '!=', 'Admin')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required'],
            'email'       => ['required'],
            'birth'       => ['required'],
            'gender'      => ['required'],
            'phone'       => ['required'],
            'address'     => ['required'],
            'ktp'         => ['nullable'],
            'photo'       => ['nullable'],
            'position_id' => ['required'],
        ]);

        try {
            $this->employee->store($request->all());
            return redirect()->route('admin.employee.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.employee.index')->with('failed', 'Data gagal disimpan');
        }
    }

    public function edit($id)
    {
        return view('admin.employee.edit', [
            'employee'  => $this->employee->getById($id),
            'positions' => $this->position->getAll()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => ['required'],
            'email'       => ['required'],
            'birth'       => ['required'],
            'gender'      => ['required'],
            'phone'       => ['required'],
            'address'     => ['required'],
            'ktp'         => ['nullable'],
            'photo'       => ['nullable'],
            'position_id' => ['required'],
        ]);

        try {
            $this->employee->update($id, $request->all());
            return redirect()->route('admin.employee.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.employee.index')->with('failed', 'Data gagal diubah');
        }
    }

    public function destroy($id)
    {
        $this->employee->destroy($id);
        return response()->json(true);
    }
}
