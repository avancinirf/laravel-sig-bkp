<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nome', 'descricao', 'iniciado_em', 'finalizado_em', 'publico'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
