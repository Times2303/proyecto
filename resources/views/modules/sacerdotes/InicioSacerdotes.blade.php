@extends('layouts.dashboard')
@section('contenido')
    <div class="grid grid-cols-[80%_20%] gap-4">
        {{-- busqueda de personas --}}
        <div class="bg-white rounded-bl-2xl rounded-br-2xl">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-4">Filtrar</h1>
            <form action="#" method="GET">
                <input name="buscar" class="bg-gray-100 p-1 mb-2 ml-7 mt-2 w-5/6 rounded" type="text" placeholder="Nombre, Apellido, número">
                <button class="bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 py-1 mb-2 rounded" type="submit">Buscar</button>
            </form>
        </div>
        {{-- Agregar personas --}}
        <div class="bg-white rounded-bl-2xl rounded-br-2xl">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-2">Crear</h1>
            <div class="flex flex-col items-center">
                <a href="{{ route('sacerdotes.seleccionar') }}" class=" bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 pb-2 pt-1 m-2 rounded">
                    Asignar</a>
            </div>
        </div>
        {{-- Tabla personas --}}
        <div class="bg-white rounded-bl-2xl rounded-br-2xl pb-4">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pb-2 pl-4">Panel informativo</h1>
            {{-- Tabla --}}
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identificación</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                                {{-- <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nacimiento</th> --}}
                                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($sacerdote as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="pl-6 py-2 whitespace-nowrap">
                                <div class="flex items-center text-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->personas->num_identificacion }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->personas->tipos_identificacion->nom_tipo }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->personas->nombres }}</td>
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->personas->apellido1 }} {{ $item->personas->apellido2 }}</td>
                            <td class="px-2 py-2 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->personas->celular }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->personas->email }}</div>
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($item->personas->fecha_nacimiento)->locale('es')->translatedFormat('d F, Y') }}
                            </td> --}}
                            <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="#" class="text-cordes-blue hover:text-cordes-dark cursor-pointer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('sacerdotes.edit', $item->id) }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="document.getElementById('confirmModal{{ $item->id }}').classList.remove('hidden')" class="text-red-600 hover:text-red-800 cursor-pointer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @include('partials.confirmar', [
                                        'id' => 'confirmModal' . $item->id,
                                        'action' => route('sacerdotes.destroy', $item->id),
                                        'method' => 'DELETE',
                                        'title' => 'Eliminar Sacerdote',
                                        'message' => '¿Estás seguro de eliminar a ' . $item->personas->nombres . '?',
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
                            {{ $sacerdote->links() }}
                        </div>
                </div>
        </div>
        {{-- estadisticas de personas --}}
        <div class="bg-white rounded-bl-2xl rounded-br-2xl">
            <div class="bg-cordes-blue p-0.5"></div>
            <h1 class="text-gray-800 pl-4 pb-2">Estadisticas</h1>
            <div class="ml-2 mb-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold rounded-full overflow-hidden">
                <div class="px-3 py-1 bg-green-200">Total de Sacerdotes</div>
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