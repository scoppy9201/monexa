<?php

declare(strict_types=1);

namespace FuteBus\Core\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'department',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];
}
