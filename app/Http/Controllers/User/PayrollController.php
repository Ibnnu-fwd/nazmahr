<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\PayrollInterface;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    private $payroll;

    public function __construct(PayrollInterface $payroll)
    {
        $this->payroll = $payroll;
    }

    public function index(Request $request)
    {
        // return $this->payroll->getById(auth()->user()->id);
        if ($request->ajax()) {
            return datatables()
                ->of([$this->payroll->getById(auth()->user()->id)])
                ->addColumn('employee', function ($data) {
                    return view('user.payroll.column.employee', compact('data'));
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
                    return view('user.payroll.column.action', [
                        'data'  => $data,
                        'month' => request()->date ?? date('Y-m')
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('user.payroll.index');
    }

    public function monthlyRecap($month)
    {
        return view('user.payroll.monthly_recap', [
            'monthlyRecap' => $this->payroll->getMonthlyRecap(auth()->user()->id, $month),
            'month'        => $month
        ]);
    }
}
