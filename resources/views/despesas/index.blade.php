<x-app-layout>
    <div class="flex min-h-screen bg-gray-200">
        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-800 shadow-md p-4">
            <button class="w-full bg-red-500 text-white rounded-lg py-2 mb-4">+ Novo</button>
            <nav class="space-y-3">
                <a href="#" class="block text-gray-100 hover:text-blue-600">Dashboard</a>
                <a href="#" class="block text-gray-100 hover:text-blue-600">Cartões de crédito</a>
            </nav>
        </aside>

        {{-- Conteúdo principal --}}
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Despesas</h2>
                <button href="{{ route('despesas.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600">+ Nova Despesa</button>
            </div>

            {{-- Cards --}}
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

            {{-- Tabela --}}
            <div class="bg-white rounded-xl shadow p-4">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left text-gray-600 border-b">
                            <th class="py-2">Situação</th>
                            <th class="py-2">Data</th>
                            <th class="py-2">Descrição</th>
                            <th class="py-2">Valor</th>
                            <th class="py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($despesas as $despesa)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 text-center">
                                    @if($despesa->status === 'pago')
                                        ✅
                                    @else
                                        ⏳
                                    @endif
                                </td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($despesa->data_vencimento)->format('d/m/Y') }}</td>
                                <td class="py-2">{{ $despesa->descricao }}</td>
                                <td class="py-2 text-red-500 font-semibold">
                                    R$ {{ number_format($despesa->valor_total, 2, ',', '.') }}
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-500 hover:underline">Editar</button>
                                    <form action="{{ route('despesas.destroy', $despesa) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                    </form>
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