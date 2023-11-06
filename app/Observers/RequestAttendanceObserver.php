<?php

namespace App\Observers;

class RequestAttendanceObserver
{
    public function creating($params)
    {
        auth()->check() ? $params->created_by = auth()->user()->id : null;
    }

    public function updating($params)
    {
        auth()->check() ? $params->updated_by = auth()->user()->id : null;
    }
}