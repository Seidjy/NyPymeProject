<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    protected $table = 'log_prize';
    protected $fillable = [
        'id', 'ip', 'action','novo_nome', 'antigo_nome', 'novo_preco', 'antigo_preco','cnpj','price',
    ];
}