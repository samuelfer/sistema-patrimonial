<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Sector extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'sigla', 'status', 'management_unit_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'sigla', 'status', 'management_unit_id'])
        ->dontSubmitEmptyLogs();
    }

    public function managementUnit(): BelongsTo
    {
        return $this->belongsTo(ManagementUnit::class);
    }
}
