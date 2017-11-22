<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'id', 'name', 'idRuleToAchieve', 'idRuleToRestrict', 'idRuleToAward','cnpj',
    ];

    public function rules_to_achieve()
    {
        return $this->hasOne('App\RulesToAchieve');
    }

    public function rules_to_restrict()
    {
        return $this->hasOne('App\RulesToRestrict');
    }

    public function rules_to_award()
    {
        return $this->hasOne('App\RulesToAward');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
