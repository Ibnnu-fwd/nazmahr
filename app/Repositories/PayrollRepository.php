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
            // Filter attendance that is up to 30 minutes late from the start time.
            $attendances = $attendances->filter(function ($attendance) {
                $entryTime = date('H:i:s', strtotime($attendance->entry_at));
                $startTime = date('H:i:s', strtotime($attendance->attendanceTimeConfig->start_time));
                $lateTime  = date('H:i:s', strtotime($attendance->attendanceTimeConfig->start_time . '+30 minutes'));

                return $entryTime >= $startTime && $entryTime <= $lateTime;
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

    /**
     * Retrieve monthly recap for an employee.
     *
     * @param int $id The ID of the employee.
     * @param string $date The date to retrieve the monthly recap for.
     * @return mixed The employee object with attendance, salary, total salary, total attendance, total reimbursement, total task, and total payroll.
     */
    public function getMonthlyRecap($id, $date)
    {
        $employee = $this->employee->with(['tasks', 'request_reimbursements', 'position', 'permit_leaves'])->find($id);
        $month    = Carbon::parse($date)->month;

        $attendances = $this->attendance->where('user_id', $employee->id)->whereMonth('entry_at', $month)->get();

        $totalDayPermitLeave = 0;
        // Filter permit leaves that are approved in the selected month.
        $permitLeaves = $employee->permit_leaves->filter(function ($permitLeave) use ($month, &$totalDayPermitLeave) {
            // get total day permit leave in the selected month in start_date to end_date
            $totalDayPermitLeave += Carbon::parse($permitLeave->start_date)->diffInDays(Carbon::parse($permitLeave->end_date));
            $date = Carbon::parse($permitLeave->start_date);
            return $date->month == $month && $permitLeave->status == 'approved';
        });

        // Filter attendance that is up to 30 minutes late from the start time.
        $attendances = $attendances->filter(function ($attendance) {
            $entryTime = date('H:i:s', strtotime($attendance->entry_at));
            $startTime = date('H:i:s', strtotime($attendance->attendanceTimeConfig->start_time));
            $lateTime  = date('H:i:s', strtotime($attendance->attendanceTimeConfig->start_time . '+30 minutes'));

            return $entryTime >= $startTime && $entryTime <= $lateTime;
        });

        $employee->total_permit_leave  = $totalDayPermitLeave;
        $employee->total_absent       = date('t', strtotime($date)) - $attendances->count();
        $employee->attendance          = $attendances;
        $total_attendance              = $attendances->count();
        $employee->salary              = $employee->salary;
        $employee->total_salary        = $this->payroll::AMOUNT_PER_DAY * $total_attendance;
        $employee->total_attendance    = $total_attendance;
        $employee->total_reimbursement = $this->calculateTotalReimbursement($employee, $month);
        $employee->total_task          = $this->calculateTotalTask($employee, $month);
        $employee->total_payroll       = $employee->total_salary + $employee->total_reimbursement + $employee->total_task;

        return $employee;
    }

    /**
     * Calculate total reimbursement for an employee.
     *
     * @param \App\Models\User $employee The employee object.
     * @param int $month The month to calculate the total reimbursement for.
     * @return int The total reimbursement for the employee.
     */
    private function calculateTotalReimbursement($employee, $month)
    {
        return $employee->request_reimbursements->filter(function ($reimbursement) use ($month) {
            $date = Carbon::parse($reimbursement->date);
            return $date->month == $month && $reimbursement->status == 1;
        })->sum('nominal');
    }

    /**
     * Calculate total task for an employee.
     *
     * @param \App\Models\User $employee The employee object.
     * @param int $month The month to calculate the total task for.
     * @return int The total task for the employee.
     */
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