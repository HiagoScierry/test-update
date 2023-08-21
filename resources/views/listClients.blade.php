@include('./include/header')

<div class="m-20">

    <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-3 text-gray-700">Filtrar Clientes</h2>
        <form method="GET">
            <div class="flex items-center justify-between gap-10">
                <div class="w-full">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Cliente:</label>
                    <input type="text" name="nome" id="nomeFilter" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="w-full">
                    <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
                    <input type="text" name="cpf" id="cpfFilter" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="w-full">
                    <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento:</label>
                    <input type="date" name="data_nascimento" id="data_nascimentoFilter" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="w-full">
                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                    <select name="sexo" id="sexo" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value=""></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between gap-10 mt-4">

                <div class="w-full">
                    <select aria-placeholder="Estado" name="uf" id="ufFilter" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="populateCities()">
                        <option value="" disabled selected>Estado</option>
                    </select>
                </div>
                <div class="w-full">
                    <select name="city" id="cityFilter" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" disabled selected>Cidade</option>
                    </select>
                </div>


                <button onclick="filterData()" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Filtrar</button>
            </div>
        </form>
    </div>


    <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold mb-3 text-gray-700">Lista de Clientes</h2>
            <button onclick="openModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Adicionar Novo</button>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto rounded-md w-full border-collapse">
                <thead>
                    <tr class="bold">
                        <th class="border px-4 py-2 text-left">Nome</th>
                        <th class="border px-4 py-2 text-left">CPF</th>
                        <th class="border px-4 py-2 text-left">Data de Nascimento</th>
                        <th class="border px-4 py-2 text-left">Sexo</th>
                        <th class="border px-4 py-2 text-left">Estado</th>
                        <th class="border px-4 py-2 text-left">Cidade</th>
                        <th class="border px-4 py-2 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                    <tr>
                        <td class="border px-4 py-2">{{ $client->name }}</td>
                        <td class="border px-4 py-2">{{ $client->document }}</td>
                        <td class="border px-4 py-2">{{ $client->birth_date }}</td>
                        <td class="border px-4 py-2">{{ $client->sex }}</td>
                        <td class="border px-4 py-2">{{ $client->state }}</td>
                        <td class="border px-4 py-2">{{ $client->city }}</td>
                        <td class="border px-4 py-2">
                            <button onclick="deleteClient('{{$client->id}}')" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
            </div>
        </div>
    </div>


    <div id="Modal-add" class="hidden">
        <div class="fixed inset-0 flex items-center justify-center z-50 ">
            <div class="modal-overlay fixed inset-0 bg-black opacity-50"></div>
            <div class="modal-container w-full md:max-w-5xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-3 text-gray-700">Criar Clientes</h2>
                    <form method="GET">
                        <div class="flex items-center justify-between gap-10">
                            <div class="w-full">
                                <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Cliente:</label>
                                <input type="text" name="nome" id="nome" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
                                <input type="text" name="cpf" id="cpf" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento:</label>
                                <input type="date" name="data_nascimento" id="data_nascimento" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                                <select name="sexo" id="sexo" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-10 mt-4">
                            <div class="w-full">
                                <input type="text" placeholder="Endereço" name="endereco" id="endereco" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full">
                                <select aria-placeholder="Estado" name="uf" id="uf" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="populateCities()">
                                    <option value="" disabled selected>Estado</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <select name="city" id="city" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled selected>Cidade</option>
                                </select>
                            </div>


                            <button" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

</div>


<script>
    //Populando os estados e cidades
    const statesAndCities = [{
            state: "Rio de Janeiro",
            uf: "RJ",
            cities: [
                "Rio de Janeiro",
                "Niterói",
                "São Gonçalo"
            ],

        },
        {
            state: "São Paulo",
            uf: "SP",
            cities: [
                "São Paulo",
                "Santos",
                "Campinas"
            ],

        },
        {
            state: "Espirito Santo",
            uf: "ES",
            cities: [
                "Vitória",
                "Vila Velha",
                "Serra"
            ],
        }

    ]



    function populateUfs() {
        const ufSelect = document.getElementById("ufFilter");

        statesAndCities.forEach(state => {
            ufSelect.innerHTML += `<option value="${state.uf}">${state.state}</option>`
        })
    }

    function populateCities() {
        const stateInput = document.getElementById("ufFilter");
        const citySelect = document.getElementById("city")

        const selectedIndex = stateInput.selectedIndex;

        const selectedState = statesAndCities[selectedIndex]

        citySelect.innerHTML = ""
        selectedState.cities.forEach(city => {
            citySelect.innerHTML += `<option value="${city}">${city}</option>`
        })

        citySelect.disabled = false
    }

    populateUfs();



    //Deletando clientes
    async function deleteClient(id) {

        await fetch(`http://localhost:8000/api/clients/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())

        window.location.reload()

    }


    //Adicionando clientes
    function openModal() {
        const modal = document.getElementById("Modal-add")
        modal.classList.remove("hidden")
        modal.classList.add("block")
    }

    function closeModal() {
        const modal = document.getElementById("Modal-add")
        modal.classList.remove("block")
        modal.classList.add("hidden")
    }

    const outOfModal = document.getElementsByClassName("modal-overlay")[0];
    outOfModal.addEventListener("click", closeModal)



    //Filtrando clientes
   function filterData(){
    const name = document.getElementById("nomeFilter").textContent
    const cpf = document.getElementById("cpfFilter").textContent
    const nascimento = document.getElementById("data_nascimentoFilter").textContent
    const sexo = document.getElementById("sexoFilter");
    const uf = document.getElementById("ufFilter").value
    const city = document.getElementById("cityFilter").value

    console.log(sexo.options[sexo.selectedIndex].text);

    if(name == "" && cpf == "" && nascimento == "" && sexo == "" && uf == "" && city == "") {
        alert("Preencha pelo menos um campo para filtrar");
        return;
    }

    let filters = ""

    if(name != "") {
        filters += `name=${name}&`
    }

    if(cpf != "") {
        filters += `document=${cpf}&`
    }

    if(nascimento != "") {
        filters += `birth_date=${nascimento}&`
    }

    if(sexo.options[sexo.selectedIndex].text != "") {
        filters += `sex=${sexo}&`
    }

    if(uf != "") {
        filters += `state=${uf}&`
    }

    if(city != "") {
        filters += `city=${city}&`
    }




    location.href = `http://localhost:8000/api/clients/?${filters}`


   }



</script>


@include('./include/footer')