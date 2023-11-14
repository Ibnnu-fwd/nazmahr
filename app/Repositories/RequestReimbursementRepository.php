<?php

namespace App\Repositories;

use App\Interfaces\RequestReimbursementInterface;
use App\Models\RequestReimbursement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestReimbursementRepository implements RequestReimbursementInterface
{
    private $requestReimbursement;

    public function __construct(RequestReimbursement $requestReimbursement)
    {
        $this->requestReimbursement = $requestReimbursement;
    }

    public function getAll()
    {
        return $this->requestReimbursement->with(['user'])->get();
    }

    public function getById($id)
    {
        return $this->requestReimbursement->with(['user'])->find($id);
    }

    public function store($data)
    {
        if (isset($data['bill_attachment'])) {
            $filenameBillAttachment = uniqid() . '.' . $data['bill_attachment']->extension();
            $data['bill_attachment']->storeAs('public/reimbursement/bill', $filenameBillAttachment);
            $data['bill_attachment'] = $filenameBillAttachment;
        }

        DB::beginTransaction();

        try {
            $this->requestReimbursement->create($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/reimbursement/bill/' . $filenameBillAttachment);
            DB::rollback();
            throw $th;
        }
    }

    public function updateAdmin($id, $data)
    {
        $requestReimbursement = $this->requestReimbursement->find($id);

        if (isset($data['bill_attachment'])) {
            $filenameBillAttachment = uniqid() . '.' . $data['refund_attachment']->extension();
            $data['refund_attachment']->storeAs('public/reimbursement/bill', $filenameBillAttachment);
            $data['bill_attachment'] = $filenameBillAttachment;
            if ($requestReimbursement->bill_attachment) Storage::delete('public/reimbursement/bill/' . $requestReimbursement->bill_attachment);
        }

        DB::beginTransaction();

        try {
            $requestReimbursement->updateAdmin($data);
            DB::commit();
        } catch (\Throwable $th) {
            Storage::delete('public/reimbursement/bill/' . $filenameBillAttachment);
            DB::rollback();
            throw $th;
        }
    }

    public function update($id, $data)
    {
        return $this->requestReimbursement->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->requestReimbursement->find($id)->delete();
    }

    public function changeStatus($id, $status)
    {
        return $this->requestReimbursement->find($id)->update([
            'status' => $status
        ]);
    }
}
