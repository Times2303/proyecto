@extends('layouts.dashboard')
@section('contenido')
<input type="text" name="modo" value="{{ $modo }}" class="hidden">
    <a href="{{ route('personas.create') }}" class="bg-times-verde hover:bg-times-hverde transition-colors duration-200 rounded cursor-pointer text-white px-4 py-2">
        Agregar Persona
    </a>

    {{--card--}}
    <div class="shadow-lg">
        {{--header--}}
        <div class="mt-5 bg-white p-3 pl-5 rounded font-sans">
            <h2>Lista de personas</h2>
        </div>
        {{--Descargar--}}
        <div class="bg-times-bg">
            <div class="flex justify-end m-2 space-x-2">
                <h2 class="bg-times-morado px-4 py-1">Descargar</h2>
                <button class="bg-times-gris hover:bg-times-hgris cursor-pointer px-4 py-1 rounded">Excel</button>
                <button class="bg-times-gris hover:bg-times-hgris cursor-pointer px-4 py-1 rounded">PDF</button>
            </div>
        </div>
        {{--Busqueda--}}
        <div class="flex m-2 space-x-2">
            <h2 class="pl-4 py-1">Buscar:</h2>
            <form action="#" method="GET" class="flex flex-1 space-x-2">
                <input name="buscar" class="bg-white px-4 py-1 rounded w-full focus:outline-none focus:border-1" type="text" placeholder="Nombre, Apellido, número">
                <button class="text-white bg-times-azul hover:bg-times-hazul cursor-pointer px-4 py-1 rounded" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        {{--Tabla--}}
        <div class="overflow-x-auto px-4 pb-4">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identificación</th>
                        <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres</th>
                        <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                        <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                        <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($personas as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-2 whitespace-nowrap">
                            <div class="">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $item->num_identificacion }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->tipos_identificacion->nom_tipo }}</div>
                                </div>
                            </div>
                        </td>
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
                        <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">       
                            <div class="flex space-x-2">
                                @switch($modo)
                                    @case('sacerdote')
                                        <a href="{{ route('sacerdotes.create', ['persona_id' => $item->id]) }}" class="bg-times-morado hover:bg-times-hmorado text-white cursor-pointer px-2.5 py-1 rounded-2xl">
                                            Asignar
                                        </a>
                                        @break
                                    @case('comprobante')
                                        <a href="{{ route('comprobantes.create', ['persona_id' => $item->id]) }}" class="bg-times-azul hover:bg-times-hazul text-white cursor-pointer px-2.5 py-1 rounded-2xl">
                                            Asignar
                                        </a>
                                        @break
                                    @default
                                        <a href="#" class="text-times-azul hover:text-times-hazul cursor-pointer">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('personas.edit', $item->id) }}" class="text-times-gris hover:text-times-hgris cursor-pointer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" onclick="document.getElementById('confirmModal{{ $item->id }}').classList.remove('hidden')" class="text-times-red hover:text-times-hred cursor-pointer">
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
                                @endswitch
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
                {{--paginacion--}}
                <div class="pl-4 mr-4">
                    {{ $personas->links() }}
                </div>
        </div>
    </div>
@endsection