<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAward extends Model
{
    protected $fillable = [
        'id', 'name',
    ];
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
