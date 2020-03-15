<?php

namespace App\Http\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ScheduleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('created_at', '<', Carbon::now());
    }
}
