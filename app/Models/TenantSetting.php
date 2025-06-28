<?php

namespace App\Models;

use App\Trait\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSetting extends Model
{
    /** @use HasFactory<\Database\Factories\TenantSettingFactory> */
    use HasFactory, Tenantable;
}
