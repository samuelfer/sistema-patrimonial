<?php

namespace App\Models\Scopes;

use App\Models\ManagementUnit;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(auth()->user()) {
            if($model instanceof ManagementUnit) {
                $builder->where('id', auth()->user()->management_unit_id);
            } else {
                $builder->where('management_unit_id', auth()->user()->management_unit_id);
            }
        }
    }
}