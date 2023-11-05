<?php

namespace App\Observers;

class TaskObserver
{
    public function creating($model)
    {
        auth()->check() ? $model->created_by = auth()->user()->id : '';
    }

    public function updating($model)
    {
        auth()->check() ? $model->updated_by = auth()->user()->id : '';
    }
}
