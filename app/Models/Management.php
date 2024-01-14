<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Management extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['start', 'end', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['start', 'end', 'status'])
        ->dontSubmitEmptyLogs();
    }
}
