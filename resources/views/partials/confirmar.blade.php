<div id="{{ $id }}" class="fixed inset-0 z-40 min-h-full overflow-y-auto overflow-x-hidden transition items-center hidden">
    <!-- overlay -->
    <div onclick="document.getElementById('{{ $id }}').classList.add('hidden')" aria-hidden="true" class="fixed inset-0 w-full h-full bg-black/50 cursor-pointer"></div>

    <!-- Modal -->
    <div class="relative w-full pointer-events-none transition my-auto p-4">
        <div class="w-full py-2 bg-white pointer-events-auto relative rounded-xl mx-auto max-w-sm">

            <!-- Botón cerrar -->
            <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" type="button" class="absolute top-2 right-2">
                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Contenido -->
            <div class="p-4 text-center text-gray-800  space-y-2">
                <h2 class="text-xl font-bold">{{ $title ?? '¿Estás seguro?' }}</h2>
                <p class="text-gray-500">{{ $message ?? 'Esta acción no se puede deshacer.' }}</p>
            </div>

            <!-- Botones -->
            <div class="px-2 py-2 grid grid-cols-2 gap-2  border-t border-gray-700">
                <button onclick="document.getElementById('{{ $id }}').classList.add('hidden')" class="w-full text-gray-800 bg-white border border-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg px-4 py-1 cursor-pointer">
                    Cancelar
                </button>

                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if(isset($method) && $method !== 'POST')
                        @method($method)
                    @endif
                    <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-500 rounded-lg px-6 py-1 cursor-pointer">
                        {{ $buttonText ?? 'Confirmar' }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
