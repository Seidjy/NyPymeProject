<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGoals extends Model
{
	protected $fillable = [
        'id', 'idGoals', 'idCustomers', 'amount', 'cnpj',
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    public function goal()
    {
        return $this->hasOne('App\Goal');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
