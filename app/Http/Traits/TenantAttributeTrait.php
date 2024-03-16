<?php

namespace App\Http\Traits;

trait TenantAttributeTrait
{
    public static function bootTenantAttributeTrait()
    {
        static::creating(function ($model) {
            $model->management_unit_id = auth()->user()->management_unit_id;
        });
        static::retrieved(function ($model) {
            $model->where('management_unit_id', auth()->user()->management_unit_id);
        });
    }
}