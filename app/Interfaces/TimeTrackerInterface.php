<?php

namespace App\Interfaces;

interface TimeTrackerInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function update($id, $data);
    public function destroy($id);
    public function start($id);
    public function stop($id);
    public function continue($id);
}
