<?php

namespace App\Http\Traits;

use App\Models\Scopes\TenantScope;

trait TenantScoped
{
    public static function bootTenantScoped()
    {
        static::addGlobalScope(new TenantScope);
    }
}