<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class OrganResponsible extends Model
{
    protected $table = 'organs_responsibles';
    use HasFactory;
    protected $fillable = ['people_id', 'situation_id', 'organ_id', 'date_start', 'date_end'];

    protected $casts = [
        'date_start' => 'datetime:Y-m-d',
        'date_end'   => 'datetime:Y-m-d',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['people_id', 'situation_id', 'organ_id', 'date_start', 'date_end'])
        ->dontSubmitEmptyLogs();
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function situation()
    {
        return $this->belongsTo(Situation::class);
    }
    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }


}
