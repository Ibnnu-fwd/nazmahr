<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RequestReimbursementInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $reimbursement;

    public function __construct(RequestReimbursementInterface $reimbursement)
    {
        $this->reimbursement = $reimbursement;
    }

    public function index()
    {
        $reimbursements = $this->reimbursement->getAll()->where('status', 0);
        return view('admin.dashboard', [
            'reimbursements' => $reimbursements,
        ]);
    }
}
