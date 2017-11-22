<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesToAward extends Model
{
    protected $fillable = [
        'id', 'name', 'idTypeAward','amount','cnpj',
    ];
    public function type_award()
    {
        return $this->hasOne('App\TypeAward');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}