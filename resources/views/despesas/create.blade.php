<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-semibold mb-6">Nova Despesa</h2>

        <form action="{{ route('despesas.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Descrição --}}
            <div>
                <label class="block text-gray-700 font-medium">Descrição</label>
                <input 
                    type="text" 
                    name="descricao" 
                    class="w-full border-gray-300 rounded-lg shadow-sm" 
                    required
                >
            </div>

            {{-- Valor total --}}
            <div>
                <label class="block text-gray-700 font-medium">Valor Total</label>
                <input 
                    type="number" 
                    name="valor_total" 
                    step="0.01" 
                    class="w-full border-gray-300 rounded-lg shadow-sm" 
                    required
                >
            </div>

            {{-- Parcelas --}}
            <div>
                <label class="block text-gray-700 font-medium">Parcelas</label>
                <input 
                    type="number" 
                    name="parcelas" 
                    min="1" 
                    value="1"
                    class="w-full border-gray-300 rounded-lg shadow-sm" 
                    required
                >
            </div>

            {{-- Data de vencimento --}}
            <div>
                <label class="block text-gray-700 font-medium">Data de Vencimento</label>
                <input 
                    type="date" 
                    name="data_vencimento" 
                    class="w-full border-gray-300 rounded-lg shadow-sm" 
                    required
                >
            </div>

            {{-- Categoria (funciona só se você criar na migration!) --}}
            <div>
                <label class="block text-gray-700 font-medium">Categoria</label>
                <select 
                    name="categoria" 
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    required
                >
                    <option value="mercado">Mercado</option>
                    <option value="luz">Luz</option>
                    <option value="agua">Água</option>
                    <option value="cartao">Cartão de Crédito</option>
                    <option value="transportes">Transportes</option>
                    <option value="internet">Internet</option>
                    <option value="outros">Outros</option>
                </select>
            </div>

            {{-- Botões --}}
            <div class="flex justify-end">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="px-4 py-2 bg-gray-300 rounded-lg mr-2"
                >
                    Cancelar
                </a>

                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Salvar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
