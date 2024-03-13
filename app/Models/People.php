<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class People extends Model
{
    use HasFactory, SoftDeletes;

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

}
