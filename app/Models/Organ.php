<?php

namespace App\Models;

use App\Models\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Organ extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = ['name', 'sigla', 'description', 'management_unit_id', 
        'address', 'status', 'phone', 'email', 'people_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'sigla', 'description', 'management_unit_id', 'address', 'status',
             'phone', 'email', 'people_id'])
        ->dontSubmitEmptyLogs();
    }

    public function managementUnit(): BelongsTo
    {
        return $this->belongsTo(ManagementUnit::class);
    }

    public function sector(): HasMany
    {
        return $this->hasMany(Sector::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }

    public function getSiglaAttribute($value)
    {
        return mb_strtoupper($value);
    }

    //Responsavel pelo orgao
    public function people() 
    {
        return $this->belongsTo(People::class);
    }
}
