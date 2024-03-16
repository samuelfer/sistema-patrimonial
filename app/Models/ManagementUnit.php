<?php

namespace App\Models;

use App\Http\Traits\TenantAttributeTrait;
use App\Http\Traits\TenantScoped;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class ManagementUnit extends Model
{
    use HasFactory, LogsActivity, SoftDeletes, TenantAttributeTrait, TenantScoped;

    protected $table = 'management_units';

    protected $fillable = ['name', 'cod', 'description', 'cnpj', 'phone', 'email', 
                            'people_id', 'status'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'cod', 'description', 'cnpj', 'phone', 'email' , 'people_id'])
        ->dontSubmitEmptyLogs();
    }

    //Responsavel pela unidade gestora
    public function people() 
    {
        return $this->belongsTo(People::class);
    }
}
