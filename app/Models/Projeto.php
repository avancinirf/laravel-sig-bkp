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

    public function rules() {
        $id = $this->id ?? 'NULL';
        return [
            'nome' => 'required|unique:projetos,nome,'.$id.'|min:10|max:100',
            'descricao' => 'max:1000',
            'iniciado_em' => 'date|nullable',
            'finalizado_em' => 'date|nullable',
            'publico' => 'boolean',
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'nome.unique' => 'Nome do projeto já existe',
            'nome.min' => 'Nome deve conter no mínimo 10 caracteres.',
            'nome.max' => 'Nome deve conter no máximo 100 caracteres.',
            'date' => 'Formato de data inválido.',
            'descricao.max' => 'Descrição deve conter no máximo 1000 caracteres.'
        ];
    }

}
