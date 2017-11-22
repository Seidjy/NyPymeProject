<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = [
        'id', 'cpf', 'name', 'points','cnpj',
    ];
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
