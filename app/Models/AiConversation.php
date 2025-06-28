<?php

namespace App\Models;

use App\Trait\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiConversation extends Model
{
    /** @use HasFactory<\Database\Factories\AiConversationFactory> */
    use HasFactory, Tenantable;
}
