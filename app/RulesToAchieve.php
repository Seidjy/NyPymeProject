<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesToAchieve extends Model
{
    protected $table = 'rules_to_achieves';
    protected $fillable = [
        'id', 'name', 'idTypeAchieve', 'amount', 'gather','cnpj',
    ];
    public function type_achieve()
    {
        return $this->hasOne('App\TypeAchieve');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}