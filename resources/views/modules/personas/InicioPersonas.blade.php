@extends('layouts.dashboard')
@section('contenido')
    <div class="grid grid-cols-[80%_20%] gap-2">
        {{-- busqueda de personas --}}
        <div class="bg-white">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-2">Filtrar</h1>
            <form action="#" method="GET">
                <input name="buscar" class="bg-gray-100 p-1 mb-2 ml-2 mt-2 w-5/6 rounded" type="text" placeholder="Nombre, Apellido, número">
                <button class="bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 py-1 mb-2 rounded" type="submit">Buscar</button>
            </form>
        </div>
        {{-- Agregar personas --}}
        <div class="bg-white">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-2">Crear</h1>
            <div class="flex flex-col items-center">
                <a href="{{ route('personas.create') }}" class=" bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 pb-2 pt-1 m-2 rounded">Agregar Persona</a>
            </div>
        </div>
        {{-- Tabla personas --}}
        <div class="bg-white pb-2 ">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-2 pb-2">Panel informativo</h1>
            {{-- Tabla --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nacimiento</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($personas as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->tipos_identificacion->nom_tipo }}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->num_identificacion }}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->nombres }}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->apellido1 }} {{ $item->apellido2 }}</td>
                            <td class="px-2 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->celular }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->fecha_nacimiento)->locale('es')->translatedFormat('d F, Y') }}
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-cordes-blue hover:text-cordes-dark cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('personas.edit', $item->id) }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="document.getElementById('confirmModal{{ $item->id }}').classList.remove('hidden')" class="text-red-600 hover:text-red-800 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @include('partials.confirmar', [
                                        'id' => 'confirmModal' . $item->id,
                                        'action' => route('personas.destroy', $item->id),
                                        'method' => 'DELETE',
                                        'title' => 'Eliminar persona',
                                        'message' => '¿Estás seguro de eliminar a ' . $item->nombres . '?',
                                        'buttonText' => 'Eliminar'
                                    ])

                                    
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="text-center pt-5" colspan="7">No hay datos en la tabla...</td>
                            </tr>
                        @endforelse
                        </tbody>
                            
                    </table>
                        <div class="pl-4 mr-4">
                            {{ $personas->links() }}
                        </div>
                </div>
        </div>
        {{-- estadisticas de personas --}}
        <div class="bg-white">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-2 pb-2">Estadisticas</h1>
            <div class="ml-2 mb-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold rounded-full overflow-hidden">
                <div class="px-3 py-1 bg-green-200">Total de personas</div>
                <div class="px-3 py-1">{{ $total }}</div>
            </div>
            <br>
            <div class="ml-2 mb-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold rounded-full overflow-hidden">
                <div class="px-3 py-1 bg-green-200">[0 a 3]</div>
                <div class="px-3 py-1">20</div>
            </div>
            <br>
            <div class="ml-2 mb-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold rounded-full overflow-hidden">
                <div class="px-3 py-1 bg-green-200">[4 a 7]</div>
                <div class="px-3 py-1">30</div>
            </div>
        </div>
    </div>
@endsection