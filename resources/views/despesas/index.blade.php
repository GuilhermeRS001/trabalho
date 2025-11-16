<x-app-layout>
    
    <div class="flex min-h-screen bg-gray-200">
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Despesas</h2>
                <a href="{{ route('despesas.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">
                    + Nova Despesa
                </a>            
            </div>
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl shadow text-center">
                    <h3 class="text-gray-500">Despesas pendentes</h3>
                    <p class="text-xl font-semibold text-gray-800">
                        R$ {{ number_format($totalPendente, 2, ',', '.') }}
                    </p>    
                </div>
                <div class="bg-white p-4 rounded-xl shadow text-center">
                    <h3 class="text-gray-500">Despesas pagas</h3>
                    <p class="text-xl font-semibold text-green-600">
                        R$ {{ number_format($totalPago, 2, ',', '.') }}
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow text-center">
                    <h3 class="text-gray-500">Total</h3>
                    <p class="text-xl font-semibold text-blue-600">
                        R$ {{ number_format($total, 2, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="bg-blue-100 p-4 rounded-lg mb-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-blue-800">
                    @php
                        $mesAtual = $despesas->first() 
                            ? \Carbon\Carbon::parse($despesas->first()->mes_referencia)
                            : \Carbon\Carbon::now();
                    @endphp
                    📅 Mês Atual: {{ $mesAtual->translatedFormat('F \d\e Y') }}
                </h3>
                <div class="flex gap-2">
                    <form action="{{ route('despesas.voltarMes') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                            ← Mês Anterior
                        </button>
                    </form>
                    <form action="{{ route('despesas.avancarMes') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Próximo Mês →
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow p-4">
                <table class="w-full border-collapse">
                    <form method="GET" class="mb-4">
                        <label class="font-semibold text-gray-600">Filtrar por categoria:</label>
                        <select name="categoria" onchange="this.form.submit()" 
                                class="border px-7 py-1 rounded-lg ml-0">
                            <option value="">Todas</option>
                            <option value="mercado" {{ request('categoria')=='mercado' ? 'selected' : '' }}>Mercado</option>
                            <option value="luz" {{ request('categoria')=='luz' ? 'selected' : '' }}>Luz</option>
                            <option value="agua" {{ request('categoria')=='agua' ? 'selected' : '' }}>Água</option>
                            <option value="cartao" {{ request('categoria')=='cartao' ? 'selected' : '' }}>Cartão</option>
                            <option value="transportes" {{ request('categoria')=='transportes' ? 'selected' : '' }}>Transportes</option>
                            <option value="internet" {{ request('categoria')=='internet' ? 'selected' : '' }}>Internet</option>
                            <option value="outros" {{ request('categoria')=='outros' ? 'selected' : '' }}>Outros</option>
                        </select>
                    </form>
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="py-2">Situação</th>
                            <th class="py-2">Data</th>
                            <th class="py-2">Descrição</th>
                            <th class="py-2">Valor</th>
                            <th class="py-2">Progresso</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($despesas as $despesa)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 text-center">
                                    @if($despesa->em_aberto)
                                        ⏳
                                    @else
                                        ✅
                                    @endif
                                </td>
                                <td class="py-2">
                                    @php
                                        $dataInicio = \Carbon\Carbon::now()->subMonths($despesa->parcelas_pagas);
                                    @endphp
                                    {{ $dataInicio->format('M/Y') }}
                                </td>
                                <td class="py-2">{{ $despesa->descricao }}</td>
                                <td class="py-2 text-red-500 font-semibold">
                                    @php
                                        $valorParcela = $despesa->parcelas > 0 
                                            ? $despesa->valor_total / $despesa->parcelas 
                                            : $despesa->valor_total;
                                    @endphp
                                    R$ {{ number_format($valorParcela, 2, ',', '.') }}/mês
                                </td>

                                <td class="py-2">
    @php
        $progressoDespesa = ($despesa->parcelas > 0) 
            ? ($despesa->parcelas_pagas / $despesa->parcelas) * 100 
            : 0;
        $totalPagoDespesa = ($despesa->valor_total / $despesa->parcelas) * $despesa->parcelas_pagas;
        $totalRestante = $despesa->valor_total - $totalPagoDespesa;
    @endphp
    <div class="w-48">
        <div class="h-2 w-full bg-gray-300 rounded mb-1">
            <div class="h-2 bg-blue-600 rounded" style="width: {{ $progressoDespesa }}%"></div>
        </div>
        <p class="text-xs text-gray-600">
            {{ $despesa->parcelas_pagas }}/{{ $despesa->parcelas }} parcelas
        </p>
        <p class="text-xs text-gray-500">
            Falta: R$ {{ number_format($totalRestante, 2, ',', '.') }}
        </p>
    </div>
</td>
    <td class="py-2">
    <div class="flex gap-2 items-center">
        <a href="{{ route('despesas.edit', $despesa->id) }}"
            class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-lg hover:bg-yellow-600">
            Editar
        </a>
        <form action="{{ route('despesas.destroy', $despesa) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600">
                Excluir
            </button>
        </form>
    </div>
</td>
</tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-4">Nenhuma despesa cadastrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>