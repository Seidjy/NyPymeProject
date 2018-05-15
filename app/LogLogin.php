<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    protected $table = 'log_login';
    protected $fillable = [
        'id', 'user', 'password', 'ip', 'action',
    ];
}