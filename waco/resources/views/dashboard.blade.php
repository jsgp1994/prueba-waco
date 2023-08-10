<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de pokemons') }} {{ $counter }}
        </h2>
    </x-slot>

    <div class="bg-gray-100 h-screen items-center mt-5">
        <div class="overflow-x-auto">
            <div class="bg-white p-4">
                <div class="grid grid-cols-5 gap-4">
                    @foreach ($pokemonList as $pokemon)
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <h1 class="text-lg font-semibold">{{ $pokemon['name'] }}</h1>
                            <button onclick="show('{{ $pokemon['name'] }}','{{ $pokemon['url'] }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver mas</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div
        id="modal"
        class="fixed inset-0 flex items-center justify-center z-50 hidden"
        style="background-color: rgba(0, 0, 0, 0.5)"
    >
        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h1 class="text-lg font-semibold" id="modal-title"></h1>
            <img src="" alt="Imagen del Pokémon" id="modal-image" class="w-32 h-32 mx-auto mt-4">
            <h3>Habilidades:</h3>
            <p id="modal-abilities"></p>
            <button
                onclick="hideModal()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mt-4"
            >
                Cerrar
            </button>
        </div>
    </div>

</x-app-layout>


<script>
    async function show(name, url ) {
        const pokemon = await fetch(url).then( r => r.json() );

        const modalTitle = document.getElementById('modal-title');
        const modalImage = document.getElementById('modal-image');
        const modalAbilities = document.getElementById('modal-abilities');
        const abilities = pokemon.abilities;

        // Recorrer el arreglo y construir la cadena
        let abilitiesString = "";
        abilities.forEach((ability, index) => {
            if (index !== 0) {
                abilitiesString += ", ";
            }
            abilitiesString += ability.ability.name;
        });

        modalTitle.textContent = `${name}`;
        modalImage.src = pokemon.sprites.front_default;
        modalAbilities.textContent = `${abilitiesString}`;


        showModal();
    }

    function showModal() {
        const modal = document.getElementById('modal');
        modal.classList.remove('hidden');
    }

    function hideModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
    }
</script>
