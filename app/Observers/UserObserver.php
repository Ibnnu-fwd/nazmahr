<?php

namespace App\Observers;

class UserObserver
{
    public function creating($params)
    {
        auth()->check() ? $params->created_by = auth()->user()->id : '';
    }

    public function updating($params)
    {
        auth()->check() ? $params->updated_by = auth()->user()->id : '';
    }
}
