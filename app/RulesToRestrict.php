<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesToRestrict extends Model
{
	protected $table = 'rules_to_restricts';
    protected $fillable = [
        'id', 'name','idTypeRestrict','amount','cnpj',
    ];

    public function type_restrict()
    {
        return $this->hasOne('App\TypeRestrict');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
