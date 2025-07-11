<?php

namespace App\Models;

use App\Trait\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscriptions extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionsFactory> */
    use HasFactory, Tenantable;
}
