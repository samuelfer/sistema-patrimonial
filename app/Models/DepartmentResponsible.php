<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DepartmentResponsible extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'department_responsible';

    protected $fillable = ['observation', 'people_id', 'management_id', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['observation', 'people_id', 'management_id', 'status'])
        ->dontSubmitEmptyLogs();
    }

    public function managements()
    {
        return $this->belongsTo(Management::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function responsible()
    {
        return $this->belongsTo(People::class);
    }
}
