<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filtro = $request->input('categoria'); 

        $query = Despesa::where('user_id', $user->id)
                        ->where('em_aberto', true);

        if ($filtro) {
            $query->where('categoria', $filtro);
        }

        $despesas = $query->get();

        $total = $despesas->sum('valor_total');
        $totalPago = $despesas->sum(fn($d) => ($d->valor_total / $d->parcelas) * $d->parcelas_pagas);
        $totalPendente = $total - $totalPago;
        
        if ($total > 0) {
            $progresso = ($totalPago / $total) * 100;
        } else {
            $progresso = 0;
        }

        return view('despesas.index', compact('despesas', 'total', 'totalPago', 'totalPendente', 'filtro','progresso'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'valor_total' => 'required|numeric',
            'parcelas' => 'required|integer|min:1',
            'data_vencimento' => 'required|date',
            'categoria' => 'required' 
        ]);

        Despesa::create([
            'user_id' => Auth::id(),
            'descricao' => $request->descricao,
            'valor_total' => $request->valor_total,
            'parcelas' => $request->parcelas,
            'parcelas_pagas' => 0,
            'data_vencimento' => $request->data_vencimento,
            'categoria' => $request->categoria,
            'em_aberto' => true 
        ]);

        return redirect()->route('despesas.index')->with('success', 'Despesa adicionada!');
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function edit(Despesa $despesa)
{
    return view('despesas.edit', compact('despesa'));
}
    public function update(Request $request, Despesa $despesa)
    {
    $request->validate([
        'descricao' => 'required|string|max:255',
        'valor_total' => 'required|numeric',
        'parcelas' => 'required|integer|min:1',
        'parcelas_pagas' => 'required|integer|min:0',
        'data_vencimento' => 'required|date',
        'categoria' => 'required|string',
    ]);

    $despesa->update($request->all());

    return redirect()->route('despesas.index')
                     ->with('success', 'Despesa atualizada com sucesso!');
}

    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return back()->with('success', 'Despesa removida!');
    }

    public function avancarMes()
    {
        $user = Auth::user();
        $despesas = Despesa::where('user_id', $user->id)
                        ->where('em_aberto', true)
                        ->get();
        
        foreach ($despesas as $despesa) {
            $despesa->parcelas_pagas += 1;
            $novoMes = \Carbon\Carbon::parse($despesa->mes_referencia)->addMonth();
            $despesa->mes_referencia = $novoMes->format('Y-m');
            if ($despesa->parcelas_pagas >= $despesa->parcelas) {
                $despesa->em_aberto = false;
            }
            $despesa->save();
        }
        
        return redirect()->route('despesas.index')->with('success', 'Mês avançado com sucesso!');
    }

    public function voltarMes()
    {
        $user = Auth::user();
        
        $despesas = Despesa::where('user_id', $user->id)->get();
        
        foreach ($despesas as $despesa) {
            if ($despesa->parcelas_pagas > 0) {
                $despesa->parcelas_pagas -= 1;
            }
            
            $mesAnterior = \Carbon\Carbon::parse($despesa->mes_referencia)->subMonth();
            $despesa->mes_referencia = $mesAnterior->format('Y-m');
            
            $despesa->em_aberto = true;
            
            $despesa->save();
        }
        
        return redirect()->route('despesas.index')->with('success', 'Voltou um mês!');
    }
}
