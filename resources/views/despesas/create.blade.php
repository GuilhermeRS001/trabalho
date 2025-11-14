<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-semibold mb-6">Nova Despesa</h2>

        <form action="{{ route('despesas.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Descrição</label>
                <input type="text" name="descricao" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block text-gray-700">Valor Total</label>
                <input type="number" name="valor_total" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>
            
            <div>
                <label class="block text-gray-700">Data de Vencimento</label>
                <input type="date" name="data_vencimento" class="w-full border-gray-300 rounded-lg shadow-sm" required>
            </div>

            <div>
                <label class="block text-gray-700">Status</label>
                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="pendente">Pendente</option>
                    <option value="pago">Pago</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('despesas.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Salvar</button>
            </div>
        </form>
    </div>
</x-app-layout>