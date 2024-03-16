<?php

namespace App\Http\Traits;

use App\Models\ManagementUnit;

trait TenantAttributeTrait
{
    public static function bootTenantAttributeTrait()
    {
        if(auth()->user() && !auth()->user()->is_admin) {
            static::creating(function ($model) {
                if(!$model instanceof ManagementUnit) {
                    $model->management_unit_id = auth()->user()->management_unit_id;
                }
            });
            static::retrieved(function ($model) {
                if($model instanceof ManagementUnit) {
                    $model->where('id', auth()->user()->management_unit_id);
                } else {
                    $model->where('management_unit_id', auth()->user()->management_unit_id);
                }
            });
        }
    }
}