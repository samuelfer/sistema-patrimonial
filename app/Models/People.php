<?php

namespace App\Models;

use App\Http\Traits\TenantAttributeTrait;
use App\Http\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class People extends Model
{
    use HasFactory, SoftDeletes, TenantAttributeTrait, TenantScoped;

    protected $table = 'peoples';
    protected $fillable=[
        'name',
        'email',
        'cpf',
        'phone',
        'rg',
        'matricula',
        'office_id',
        'status'
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'cpf', 'phone', 'rg', 'matricula', 'office_id', 'status'])
            ->dontSubmitEmptyLogs();
    }
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function managementUnit() 
    {
        return $this->hasOne(ManagementUnit::class);
    }

}
