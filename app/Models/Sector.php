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

    protected $fillable = ['name', 'sigla', 'status', 'organ_id', 'description'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'sigla', 'status', 'organ_id', 'description'])
        ->dontSubmitEmptyLogs();
    }

    public function organ(): BelongsTo
    {
        return $this->belongsTo(Organ::class);
    }

    public function getSiglaAttribute($value)
    {
        return mb_strtoupper($value);
    }
}
