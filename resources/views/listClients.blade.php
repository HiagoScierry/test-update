@include('./include/header')

<div class="m-20">

    <div class="mx-4 mt-5 p-5 bg-slate-500 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-3 text-gray-700">Filtrar Clientes</h2>
        <div>
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
                    <select name="sexo" id="sexoFilter" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value=""></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between gap-10 mt-4">

                <div class="w-full">
                    <select aria-placeholder="Estado" name="uf" id="ufFilter" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="populateCities(0)">
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
        </div>
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
                        <td class="border px-4 py-2 flex justify-between gap-2">
                            <button onclick="getDataFromID('{{$client->id}}')" class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50">Editar</button>
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
                    <div>
                        <div class="flex items-center justify-between gap-10">
                            <div class="w-full">
                                <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Cliente:</label>
                                <input type="text" name="nome" id="nomeForm" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
                                <input type="text" name="cpf" id="cpfForm" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento:</label>
                                <input type="date" name="data_nascimento" id="data_nascimentoForm" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div class="w-full">
                                <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                                <select name="sexo" id="sexoForm" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-10 mt-4">
                            <div class="w-full">
                                <input type="text" placeholder="Endereço" name="endereco" id="enderecoForm" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="w-full">
                                <select aria-placeholder="Estado" name="uf" id="ufForm" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="populateCities(1)">
                                    <option value="" disabled selected>Estado</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <select name="city" id="cityForm" class="mt-1 p-2 block w-full text-slate-600 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled selected>Cidade</option>
                                </select>
                            </div>

                            <input type="hidden" id="editID" value="">

                            <button onclick="editClient()" id="editClient" class="hidden bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Editar</button>
                            <button onclick="createClient()" id="createClient" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">Salvar</button>
                        </div>
                    </div>
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
        const ufSelect = document.querySelectorAll("[name=uf]");

        statesAndCities.forEach(state => {
            ufSelect.forEach(select => {
                select.innerHTML += `<option value="${state.uf}">${state.state}</option>`
            })
        })
    }

    function populateCities(indexFilter) {
        const stateInput = document.querySelectorAll("[name=uf]")[indexFilter];
        const citySelect = document.querySelectorAll("[name=city]")[indexFilter];

        const selectedIndex = stateInput.selectedIndex;

        const selectedState = statesAndCities[selectedIndex - 1]

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
    function openModal(isEditable = false) {
        const modal = document.getElementById("Modal-add")
        modal.classList.remove("hidden")
        modal.classList.add("block")


        if (!isEditable) {
            document.getElementById("createClient").classList.remove("hidden")
            document.getElementById("editClient").classList.add("hidden")
        }


    }

    function closeModal() {
        const modal = document.getElementById("Modal-add")
        modal.classList.remove("block")
        modal.classList.add("hidden")
    }

    const outOfModal = document.getElementsByClassName("modal-overlay")[0];
    outOfModal.addEventListener("click", closeModal)


    async function createClient() {
        event.preventDefault()

        const name = document.getElementById("nomeForm").value
        const cpf = document.getElementById("cpfForm").value
        const nascimento = document.getElementById("data_nascimentoForm").value
        const sexo = document.getElementById("sexoForm").value
        const uf = document.getElementById("ufForm").value
        const city = document.getElementById("cityForm").value
        const endereco = document.getElementById("enderecoForm").value

        if (!name || !cpf || !nascimento || !sexo || !uf || !city) {
            alert("Preencha todos campos criar um cliente")
            return
        }

        await fetch(`http://localhost:8000/api/clients/`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name,
                    birth_date: nascimento,
                    document: cpf,
                    sex: sexo,
                    address: endereco,
                    state: uf,
                    city
                })
            }).then(response => response.json())
            .catch(err => alert(err.message))

        window.location.reload()

    }


    //Filtrando clientes
    function filterData() {

        const name = document.getElementById("nomeFilter").value
        const cpf = document.getElementById("cpfFilter").value
        const nascimento = document.getElementById("data_nascimentoFilter").value
        const sexo = document.getElementById("sexoFilter").value
        const uf = document.getElementById("ufFilter").value
        const city = document.getElementById("cityFilter").value

        if (!name && !cpf && !nascimento && !sexo && !uf && !city) {
            alert("Preencha pelo menos um campo para filtrar")
            return
        }
        window.location.href = `http://localhost:8000/?name=${name}&document=${cpf}&birth_date=${nascimento}&sex=${sexo}&state=${uf}&city=${city}`


    }



    //Editar clientes

    async function getDataFromID(id) {
        event.preventDefault()

        const response = await fetch(`http://localhost:8000/api/clients/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })

        const data = await response.json()

        document.getElementById("editID").value = id
        document.getElementById("nomeForm").value = data.name
        document.getElementById("cpfForm").value = data.document
        document.getElementById("data_nascimentoForm").value = data.birth_date
        document.getElementById("sexoForm").value = data.sex
        document.getElementById("ufForm").value = data.state
        document.getElementById("cityForm").value = data.city
        document.getElementById("enderecoForm").value = data.address

        document.getElementById("createClient").classList.add("hidden")
        document.getElementById("editClient").classList.remove("hidden")

        openModal(true)

    }

    async function editClient(id) {
        const idEdit = document.getElementById("editID").value
        const name = document.getElementById("nomeForm").value
        const cpf = document.getElementById("cpfForm").value
        const nascimento = document.getElementById("data_nascimentoForm").value
        const sexo = document.getElementById("sexoForm").value
        const uf = document.getElementById("ufForm").value
        const city = document.getElementById("cityForm").value
        const endereco = document.getElementById("enderecoForm").value

        if (!name || !cpf || !nascimento || !sexo || !uf || !city) {
            alert("Preencha todos campos para editar um cliente")
            return
        }

        fetch(`http://localhost:8000/api/clients/${idEdit}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name,
                birth_date: nascimento,
                document: cpf,
                sex: sexo,
                address: endereco,
                state: uf,
                city
            })
        }).then(response => response.json())

        window.location.reload()


    }
</script>


@include('./include/footer')