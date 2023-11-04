<?php

namespace App\Repositories;

use App\Interfaces\EmployeeInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeInterface
{
    private $employee;

    public function __construct(User $employee)
    {
        $this->employee = $employee;
    }

    public function getAll()
    {
        return $this->employee->with('position')->get();
    }

    public function getById($id)
    {
        return $this->employee->with('position')->find($id);
    }

    public function store($data)
    {
        if (isset($data['ktp'])) {
            $filenameKTP = uniqid() . '.' . $data['ktp']->extension();
            $data['ktp']->storeAs('public/ktp', $filenameKTP);
            $data['ktp'] = $filenameKTP;
        }

        if (isset($data['photo'])) {
            $filenamePhoto = uniqid() . '.' . $data['photo']->extension();
            $data['photo']->storeAs('public/photo', $filenamePhoto);
            $data['photo'] = $filenamePhoto;
        }

        $data['is_active'] = 1;
        $data['password']  = password_hash('password', PASSWORD_DEFAULT);
        $data['join_date'] = date('Y-m-d');

        DB::beginTransaction();
        try {
            $this->employee->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            // remove file
            Storage::delete('public/ktp/' . $filenameKTP);
            Storage::delete('public/photo/' . $filenamePhoto);

            DB::rollBack();
            return false;
        }
    }

    public function update($id, $data)
    {
        $employee = $this->employee->find($id);

        if (isset($data['ktp'])) {
            $filenameKTP = uniqid() . '.' . $data['ktp']->extension();
            $data['ktp']->storeAs('public/ktp', $filenameKTP);
            if ($employee->ktp != null) {
                Storage::delete('public/ktp/' . $employee->ktp);
            }
            $data['ktp'] = $filenameKTP;
        }

        if (isset($data['photo'])) {
            $filenamePhoto = uniqid() . '.' . $data['photo']->extension();
            $data['photo']->storeAs('public/photo', $filenamePhoto);
            if ($employee->photo != null) {
                Storage::delete('public/photo/' . $employee->photo);
            }
            $data['photo'] = $filenamePhoto;
        }

        DB::beginTransaction();

        try {
            $employee->update($data);
            DB::commit();
        } catch (\Throwable $th) {
            // remove file
            Storage::delete('public/ktp/' . $filenameKTP);
            Storage::delete('public/photo/' . $filenamePhoto);

            dd($th->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function destroy($id)
    {
        $employee = $this->employee->find($id);

        DB::beginTransaction();

        try {
            Storage::delete('public/ktp/' . $employee->ktp);
            Storage::delete('public/photo/' . $employee->photo);
            $employee->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }

        DB::commit();
    }
}
