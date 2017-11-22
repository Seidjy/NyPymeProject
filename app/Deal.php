<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'idCustomer','idTypeTransactions', 'amount','cnpj', 'idGoals', 'idPrize',
    ];

    public function customer()
    {
        return $this->hasOne('App\Customer');
    }
    public function type_transaction()
    {
        return $this->hasOne('App\TypeTransaction');
    }
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
 ?>