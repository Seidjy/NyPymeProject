<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogParticipant extends Model
{
    protected $table = 'log_participant';
    protected $fillable = [
        'id', 'novo_cpf', 'antigo_cpf', 'nova_pontuacao', 'antiga_pontuacao',  'ip', 'action', 'usuario'
    ];
}