<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BensLocaveis extends Model
{
    protected $table = 'bens_locaveis';

    protected $fillable = [
        'marca_id',
        'modelo',
        'registo_unico_publico',
        'cor',
        'numero_passageiros',
        'combustivel',
        'numero_portas',
        'transmissao',
        'ano',
        'manutencao',
        'preco_diario',
        'observacao'
    ];

    public function locacoes()
    {
        return $this->hasMany('App\Models\Locacoes', 'bem_locavel_id');
    }
}
