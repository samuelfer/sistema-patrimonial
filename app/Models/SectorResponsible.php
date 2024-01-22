<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class SectorResponsible extends Model
{
    use HasFactory;

    protected $table='sectors_responsibles';
    protected $fillable = ['people_id', 'sector_id', 'date_start', 'date_end', 'situation_id'];
    protected $casts = [
        'date_start' => 'datetime:Y-m-d',
        'date_end'   => 'datetime:Y-m-d',
    ];

    public function getActivitylogOptions():LogOptions{
        return LogOptions::defaults()
        ->logOnly(['people_id', 'sector_id', 'date_start', 'date_end', 'situation_id'])
        ->dontSubmitEmptyLogs();
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }

}
