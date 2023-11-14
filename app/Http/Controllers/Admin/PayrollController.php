<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmployeeInterface;
use App\Interfaces\PayrollInterface;
use App\Interfaces\RequestReimbursementInterface;
use App\Interfaces\TaskInterface;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    private $payroll;
    private $employee;
    private $task;
    private $reimbursement;

    public function __construct(PayrollInterface $payroll, EmployeeInterface $employee, TaskInterface $task, RequestReimbursementInterface $reimbursement)
    {
        $this->payroll       = $payroll;
        $this->employee      = $employee;
        $this->task          = $task;
        $this->reimbursement = $reimbursement;
    }

    public function index(Request $request)
    {
        // return $this->payroll->getAll();
        if ($request->ajax()) {
            return datatables()
                ->of($this->payroll->getAll())
                ->addColumn('employee', function ($data) {
                    return view('admin.payroll.column.employee', compact('data'));
                })
                ->addColumn('total_salary', function ($data) {
                    return 'Rp. ' . number_format($data->total_salary, 0, ',', '.');
                })
                ->addColumn('total_reimbursement', function ($data) {
                    return 'Rp. ' . number_format($data->total_reimbursement, 0, ',', '.');
                })
                ->addColumn('total_task', function ($data) {
                    return 'Rp. ' . number_format($data->total_task, 0, ',', '.');
                })
                ->addColumn('total_overtime', function ($data) {
                    return 'Rp. ' . number_format($data->total_overtime, 0, ',', '.');
                })
                ->addColumn('total_payroll', function ($data) {
                    return 'Rp. ' . number_format($data->total_payroll, 0, ',', '.');
                })
                ->addColumn('action', function ($data) {
                    return view('admin.payroll.column.action', [
                        'data'  => $data,
                        'month' => request()->date ?? date('Y-m')
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.payroll.index', [
            'employees' => $this->employee->getAll()
        ]);
    }

    public function monthlyRecap($id, $month)
    {
        return view('admin.payroll.monthly_recap', [
            'monthlyRecap' => $this->payroll->getMonthlyRecap($id, $month),
            'month'        => $month
        ]);
    }
}
