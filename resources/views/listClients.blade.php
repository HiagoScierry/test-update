@include('./include/header')


    <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-3 text-gray-700">Filtrar Clientes</h2>
        <form  method="GET">
            <div class="flex items-center justify-between">
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Cliente:</label>
                    <input type="text" name="nome" id="nome" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                    <select name="sexo" id="sexo" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado:</label>
                    <input type="text" name="estado" id="estado" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Filtrar</button>
            </div>
        </form>
    </div>


    <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-3 text-gray-700">Lista de Clientes</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Nome</th>
                        <th class="px-4 py-2 text-left">CPF</th>
                        <th class="px-4 py-2 text-left">Data de Nascimento</th>
                        <th class="px-4 py-2 text-left">Sexo</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Cidade</th>
                        <th class="px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td class="border px-4 py-2">{{ $client->nome }}</td>
                            <td class="border px-4 py-2">{{ $client->cpf }}</td>
                            <td class="border px-4 py-2">{{ $client->data_nascimento }}</td>
                            <td class="border px-4 py-2">{{ $client->sexo }}</td>
                            <td class="border px-4 py-2">{{ $client->estado }}</td>
                            <td class="border px-4 py-2">{{ $client->cidade }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('clients.edit', $client->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Editar</a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none
                                    focus:ring focus:ring-red-200 focus:ring-opacity-50">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
            <div class="mt-5">
            </div>
        </div>
    </div>

    


@include('./include/footer')