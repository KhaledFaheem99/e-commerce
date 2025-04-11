<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    protected $table    = 'pending_user';
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp'
    ];
}
