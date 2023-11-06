<?php

namespace App\Observers;

class TimeTrackerObserver
{
    public function creating($param)
    {
        auth()->check() ? $param->created_by = auth()->user()->id : null;
    }

    public function updating($param)
    {
        auth()->check() ? $param->updated_by = auth()->user()->id : null;
    }
}
