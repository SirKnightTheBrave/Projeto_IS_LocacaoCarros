<?php

namespace App\Http\Controllers;

use App\Models\BensLocaveis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BensLocaveisController extends Controller
{
    public function all_avalible(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');
        // Se não houver filtros de data ou número de hóspedes, retorna todos os imóveis
        if (!$dataInicio || !$dataFim) {
            $disponiveis = DB::table('bens_locaveis')->get();
        } else {

            // Inicia uma consulta na tabela
            $disponiveis = DB::table('bens_locaveis')
                // Filtro de imóveis com número de hóspedes suficiente: Verifica se o imóvel pode acomodar o número de hóspedes
                // Adiciona uma subquery com whereNotExists para garantir que o imóvel não esteja reservado no período desejado.
                // verifica se existe uma reserva no intervalo de datas – se existir, o imóvel será excluído do resultado.
                ->whereNotExists(function ($query) use ($dataInicio, $dataFim) {
                    //“sim, existe algo aqui”.
                    $query->select(DB::raw(1))
                        ->from('locacoes')
                        ->whereColumn('locacoes.bem_locavel_id', 'bens_locaveis.id')
                        ->where('status', 'reservado') // Verifica se a reserva está com o status 'reservado', caso lide com "cancelado"

                        // Cláusula where aninhada, ou seja, um bloco de condições agrupadas.
                        // Consulta a tabela reservas, onde estão registadas todas as reservas feitas nos imóveis.
                        ->where(function ($q) use ($dataInicio, $dataFim) {
                            // Verifica a sobreposição das datas
                            $q->where('data_inicio', '<=', $dataFim)
                                ->where('data_fim', '>=', $dataInicio);
                        });
                })
                ->get();
        }
        return (view('locacoes.index', compact('disponiveis')));
    }


    public function show(Request $request)

    {

        $veiculo = BensLocaveis::findOrFail($request->id);
        // Busca o nome da marca diretamente
        $marcaNome = DB::table('marca')->where('id', $veiculo->marca_id)->value('nome');

        // Busca as características do veículo
        $caracteristicasNomes = DB::table('bem_caracteristicas')
            ->join('caracteristicas', 'bem_caracteristicas.caracteristica_id', '=', 'caracteristicas.id')
            ->where('bem_caracteristicas.bem_locavel_id', $veiculo->id)
            ->pluck('caracteristicas.nome'); // pega só a coluna 'nome' como coleção simples


        // Passa para a view o veículo e o nome da marca e características
        return view('locacoes.reserva', compact('veiculo', 'marcaNome', 'caracteristicasNomes'));
    }



}
