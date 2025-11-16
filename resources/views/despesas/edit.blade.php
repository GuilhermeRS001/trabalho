<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-semibold mb-6">Editar Despesa</h2>

        <form action="{{ route('despesas.update', $despesa->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Descrição --}}
            <div>
                <label class="block text-gray-700 font-medium">Descrição</label>
                <input 
                    type="text" 
                    name="descricao" 
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    value="{{ $despesa->descricao }}" 
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
                    value="{{ $despesa->valor_total }}"
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
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    value="{{ $despesa->parcelas }}"
                    required
                >
            </div>

            {{-- Parcelas pagas --}}
            <div>
                <label class="block text-gray-700 font-medium">Parcelas Pagas</label>
                <input 
                    type="number" 
                    name="parcelas_pagas"
                    min="0"
                    max="{{ $despesa->parcelas }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    value="{{ $despesa->parcelas_pagas }}"
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
                    value="{{ $despesa->data_vencimento }}"
                    required
                >
            </div>

            {{-- Categoria --}}
            <div>
                <label class="block text-gray-700 font-medium">Categoria</label>
                <select 
                    name="categoria" 
                    class="w-full border-gray-300 rounded-lg shadow-sm"
                    required
                >
                    <option value="mercado" {{ $despesa->categoria == 'mercado' ? 'selected' : '' }}>Mercado</option>
                    <option value="luz" {{ $despesa->categoria == 'luz' ? 'selected' : '' }}>Luz</option>
                    <option value="agua" {{ $despesa->categoria == 'agua' ? 'selected' : '' }}>Água</option>
                    <option value="cartao" {{ $despesa->categoria == 'cartao' ? 'selected' : '' }}>Cartão</option>
                    <option value="transportes" {{ $despesa->categoria == 'transportes' ? 'selected' : '' }}>Transportes</option>
                    <option value="internet" {{ $despesa->categoria == 'internet' ? 'selected' : '' }}>Internet</option>
                    <option value="outros" {{ $despesa->categoria == 'outros' ? 'selected' : '' }}>Outros</option>
                </select>
            </div>

            {{-- Botões --}}
            <div class="flex justify-end">
                <a 
                    href="{{ route('despesas.index') }}" 
                    class="px-4 py-2 bg-gray-300 rounded-lg mr-2"
                >
                    Cancelar
                </a>

                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                >
                    Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</x-app-layout>