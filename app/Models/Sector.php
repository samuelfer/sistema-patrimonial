<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Sector extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = ['name', 'sigla', 'status', 'organ_id', 'description', 'phone', 'email', 'people_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'sigla', 'status', 'organ_id', 'description', 'phone', 'email', 'people_id'])
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

    public function responsible()
    {
        return $this->belongsTo(SectorResponsible::class);
    }

    //Responsavel pelo setor
    public function people() 
    {
        return $this->belongsTo(People::class);
    }
}
