<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ManagementUnit extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'cod', 'description', 'cnpj', 'phone'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'cod', 'description', 'cnpj', 'phone'])
        ->dontSubmitEmptyLogs();
    }
}
