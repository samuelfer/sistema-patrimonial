<?php

namespace App\Models;

use App\Http\Traits\TenantAttributeTrait;
use App\Http\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Office extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, TenantAttributeTrait, TenantScoped;

    protected $fillable = ['name', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'status'])
        ->dontSubmitEmptyLogs();
    }
}
