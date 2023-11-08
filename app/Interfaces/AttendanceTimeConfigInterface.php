<?php

namespace App\Interfaces;

interface AttendanceTimeConfigInterface
{
    public function getAll();
    public function getByDay($day);
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
}
