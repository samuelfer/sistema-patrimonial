<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ManagementUnit extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $table = 'management_units';

    protected $fillable = ['name', 'cod', 'description', 'cnpj', 'phone', 'email'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'cod', 'description', 'cnpj', 'phone', 'email'])
        ->dontSubmitEmptyLogs();
    }
}
