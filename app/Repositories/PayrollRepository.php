<?php

namespace App\Repositories;

use App\Interfaces\PayrollInterface;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;

class PayrollRepository implements PayrollInterface
{
    private $payroll;
    private $employee;
    private $attendance;

    public function __construct(Payroll $payroll, User $employee, Attendance $attendance)
    {
        $this->payroll    = $payroll;
        $this->employee   = $employee;
        $this->attendance = $attendance;
    }


    /**
     * Retrieve all employees with their payroll information.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        $employees = $this->employee
            ->where('position_id', '!=', 1)
            ->with(['tasks', 'request_reimbursements', 'position'])->get();

        $month = Carbon::now()->month;
        if (isset(request()->date)) {
            $month = Carbon::parse(request()->date)->month;
        }

        foreach ($employees as $employee) {
            $attendances = $this->attendance->where('user_id', $employee->id)->whereMonth('entry_at', $month)->get();
            $attendances = $attendances->filter(function ($attendance) {
                return Carbon::parse($attendance->entry_at)->diffInMinutes(Carbon::parse($attendance->attendanceTimeConfig->start_time)) <= 30;
            });
            $total_attendance              = $attendances->count();
            $employee->salary              = $employee->salary;
            $employee->total_salary        = $this->payroll::AMOUNT_PER_DAY * $total_attendance;
            $employee->total_attendance    = $total_attendance;
            $employee->total_reimbursement = $this->calculateTotalReimbursement($employee, $month);
            $employee->total_task          = $this->calculateTotalTask($employee, $month);
            $employee->total_payroll       = $employee->total_salary + $employee->total_reimbursement + $employee->total_task;
        }

        return $employees;
    }

    private function calculateTotalReimbursement($employee, $month)
    {
        return $employee->request_reimbursements->filter(function ($reimbursement) use ($month) {
            $date = Carbon::parse($reimbursement->date);
            return $date->month == $month && $reimbursement->status == 1;
        })->sum('nominal');
    }

    private function calculateTotalTask($employee, $month)
    {
        return $employee->tasks->filter(function ($task) use ($month) {
            $created_at = Carbon::parse($task->created_at);
            return $created_at->month == $month && $task->status == 1;
        })->sum('total_price');
    }

    public function getById($id)
    {
        return $this->payroll->with('user')->find($id);
    }

    public function store($data)
    {
        return $this->payroll->create($data);
    }

    public function update($id, $data)
    {
        return $this->payroll->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->payroll->find($id)->delete();
    }

    public function changeStatus($id, $status)
    {
        return $this->payroll->find($id)->update(['status' => $status]);
    }
}
