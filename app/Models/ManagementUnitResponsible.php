<?php

namespace App\Models;

use App\Http\Traits\TenantAttributeTrait;
use App\Http\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ManagementUnitResponsible extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, TenantAttributeTrait, TenantScoped;

    protected $table = 'management_unit_responsibles';

    protected $fillable = ['people_id', 'management_unit_id', 'date_start', 'date_end', 'situation_id'];

    protected $casts = [
        'date_start' => 'datetime:Y-m-d',
        'date_end'   => 'datetime:Y-m-d',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['people_id', 'management_unit_id', 'date_start', 'date_end', 'situation_id'])
        ->dontSubmitEmptyLogs();
    }

    public function people() 
    {
        return $this->belongsTo(People::class);
    }

    public function managementUnit() 
    {
        return $this->belongsTo(ManagementUnit::class);
    }

    public function situation() 
    {
        return $this->belongsTo(Situation::class);
    }
}
