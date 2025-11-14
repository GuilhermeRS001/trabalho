<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $despesas = Despesa::where('user_id', $user->id)->get();
        $total = $despesas->sum('valor_total');
        $totalPago = $despesas->sum(fn($d) => ($d->valor_total / $d->parcelas) * $d->parcelas_pagas);
        $totalPendente = $total - $totalPago;

        return view('despesas.index', compact('despesas', 'total', 'totalPago', 'totalPendente'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'valor_total' => 'required|numeric',
            'parcelas' => 'required|integer|min:1',
            'data_vencimento' => 'required|date',
        ]);
        return back()->with('success', 'Despesa adicionada!');
    }

    public function create()
    {
        return view('despesas.create');
    }

    public function update(Request $request, Despesa $despesa)
    {
        $despesa->update($request->all());
        return back()->with('success', 'Despesa atualizada!');
    }

    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return back()->with('success', 'Despesa removida!');
    }
}