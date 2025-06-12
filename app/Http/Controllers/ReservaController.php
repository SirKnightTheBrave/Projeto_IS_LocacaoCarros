<?php

namespace App\Http\Controllers;

use App\Models\Locacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
    //
    public function index()
    {
        // Lógica para listar reservas
    }
    public function show($id)
    {
        // Lógica para exibir detalhes de uma reserva específica
        $reserva = Locacoes::with(['bemLocavel', 'user'])->findOrFail($id);

        return view('locacoes.mostrar_reserva', compact('reserva'));
    }
    public function create($id) {}
    public function minhasReservas()
    {
        $user = Auth::user();
        $reservas = Locacoes::with(['bemLocavel']) // Eager loading
            ->where('user_id', $user->id)
            ->orderByDesc('data_inicio')
            ->get();

        return view('locacoes.locacoes', compact('reservas',));
    }
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'bem_locavel_id' => 'required|exists:bens_locaveis,id',
            'data_inicio' => 'required|date|after_or_equal:today',
            'data_fim' => 'required|date|after:data_inicio',
            'preco_total' => 'decimal:0,2|required|numeric|min:0',
        ]);


        // Verifica se:
        //      A nova reserva começa ou termina entre as datas de uma reserva existente.
        //      A nova reserva envolve completamente o intervalo de uma reserva existente.
        //      A nova reserva está completamente envolvida por uma reserva existente.


        $existeLocacao = Locacoes::where('bem_locavel_id', $validated['bem_locavel_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('data_inicio', [$validated['data_inicio'], $validated['data_fim']])
                    ->orWhereBetween('data_fim', [$validated['data_inicio'], $validated['data_fim']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('data_inicio', '<=', $validated['data_inicio'])
                            ->where('data_fim', '>=', $validated['data_fim']);
                    });
            })
            ->exists();

        if ($existeLocacao) {
            return redirect()->back()->withErrors(['error' => 'Este veiculo já está reservado para o período selecionado.']);
        }

        // Verifica se o bem locável está disponível (validação extra, se necessário)
        $disponivel = $this->disponibilidade(
            $validated['data_inicio'],
            $validated['data_fim'],
            $validated['bem_locavel_id']
        );
        if (!$disponivel) {
            return redirect()->back()->withErrors(['error' => 'Veiculo não disponível para as datas selecionadas.']);
        }

        // Criar a reserva
        $reserva = Locacoes::create([
            'user_id' => $request->user()->id,
            'bem_locavel_id' => $validated['bem_locavel_id'],
            'data_inicio' => $validated['data_inicio'],
            'data_fim' => $validated['data_fim'],
            'preco_total' => $validated['preco_total'],
            'status' => 'reservado',
        ]);

        session(['id' => $reserva->id]);
        try {
            Mail::to($request->user()->email)
                ->queue(new \App\Mail\RentalConfirmMail(
                    $request->user()->name,
                    $reserva->bemLocavel->modelo,
                    $reserva->data_inicio,
                    $reserva->data_fim,
                    $reserva->preco_total
                ));

                 return redirect()->route('locacao.show', $reserva->id)
                ->with(['success' => 'Reserva realizada com sucesso! Enviamos um e-mail de confirmação com a sua reserva.']);
        } catch (\Exception $e) {
            return redirect()->route('locacao.show', $reserva->id)
                ->withErrors(['error' => 'Erro ao enviar o e-mail de confirmação.']);
        }

    }




    public function downloadArquivo($id)
    {
        if (!session()->has('id')) {
            return redirect()->route('dashboard');
        }
        $objeto_id = session('id');

        //Verifica se $reservaId contém um objeto.
        //Se for um objeto, ela acessa sua propriedade id; caso contrário, mantém $reservaId como está.
        //Ou seja, se $objeto_id foi gravado em um array ou não (Veja o comentário no final deste .md)
        $objeto_id = is_object($objeto_id) ? $objeto_id->id : $objeto_id;

        //busca do objeto pelo id
        $objeto = Locacoes::find($id);

        if (!$objeto) {
            return redirect()->route('dashboard')->with('error', 'Objeto não encontrado.');
        }

        $pdf = Pdf::loadView('locacoes.print', ['reserva' => $objeto]);

        return $pdf->download('reserva-' . env('APP_NAME') . '-' . date('Ymd') . '.pdf');
    }

    public function edit($id)
    {
        // Lógica para exibir o formulário de edição de uma reserva específica
    }
    public function update(Request $request, $id)
    {
        // Lógica para atualizar uma reserva específica
    }
    public function disponibilidade($dataInicio, $dataFim, $id)
    {

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
            ->where('id', $id) // Filtra pelo ID do bem locável
            ->first(); // Obtém o primeiro resultado ou null se não houver

        return $disponiveis;
    }
}
