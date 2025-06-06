<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locacoes extends Model
{
    protected $table = 'locacoes';

    protected $fillable = [
        'bem_locavel_id',
        'user_id',
        'data_inicio',
        'data_fim',
        'preco_total',
        'status',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    /**
     * Relação com o utilizador que fez a reserva.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relação com o bem locável.
     */
    public function bemLocavel()
    {
        return $this->belongsTo(BensLocaveis::class, 'bem_locavel_id');
    }

    /**
     * Verifica se a reserva ainda está ativa.
     */
    public function isAtiva()
    {
        return $this->status === 'reservado' && $this->data_fim->isFuture();
    }

    /**
     * Verifica se um Bem está disponível para reserva em um intervalo de datas.
     *
     * @param int $bem_locavel_id ID do bem a ser verificado.
     * @param string|\DateTimeInterface $data_inicio da reserva desejada (formato 'Y-m-d' ou objeto DateTime).
     * @param string|\DateTimeInterface $data_fim da reserva desejada (formato 'Y-m-d' ou objeto DateTime).
     *
     * @return bool Retorna `true` se disponível, `false` caso contrário.
     */
    public function verificaDisponibilidade($bem_locavel_id, $data_inicio, $data_fim)
    {
        $reservasConflitantes = Locacoes::where('bem_locavel_id', $bem_locavel_id)
            // apenas reservas ativas
            ->where('status', 'reservado')
            ->where(function ($query) use ($data_inicio, $data_fim) {
                $query->where('data_inicio', '<=', $data_fim)
                    ->where('data_fim', '>=', $data_inicio);
            })
            ->exists();

        return !$reservasConflitantes;
    }
}
