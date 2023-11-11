<?php

namespace App\Interfaces;

interface PayrollInterface
{
    public function getAll();
    public function getById($id);
    public function getMonthlyRecap($id, $date);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
    public function changeStatus($id, $status);
}
