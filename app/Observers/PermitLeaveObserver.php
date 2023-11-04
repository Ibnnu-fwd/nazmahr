<?php

namespace App\Observers;

class PermitLeaveObserver
{
    public function creating($param)
    {
        auth()->check() ? $param->created_by = auth()->user()->id : '';
    }

    public function updating($param)
    {
        auth()->check() ? $param->updated_by = auth()->user()->id : '';
    }
}
