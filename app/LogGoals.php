<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $fillable = [
        'id', 'name', 'cnpj', 'price',
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}