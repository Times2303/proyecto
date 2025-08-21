@extends('layouts.dashboard')
@section('contenido')
<a href="{{ route('parroquias.create') }}" class="bg-times-verde hover:bg-times-hverde transition-colors duration-200 cursor-pointer text-white px-4 pb-2 pt-1 m-2 rounded">
    Nueva parroquia    
</a>
{{--card--}}
<div class="shadow-lg">
    {{--header--}}
    <div class="mt-5 bg-white p-3 pl-5 rounded font-sans">
        <h2>Lista de parroquias</h2>
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
            <input name="buscar" class="bg-white px-4 py-1 rounded w-full focus:outline-none focus:border-1" type="text">
            <button class="text-white bg-times-azul hover:bg-times-hazul cursor-pointer px-4 py-1 rounded" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
    {{--cards--}}
        <div class="grid grid-cols-4 gap-2 p-2 pl-4">
        @forelse ($parroquia as $item)
            <div class="bg-white hover:shadow-md rounded cursor-pointer">
                <div class="flex flex-col rounded pt-4">
                    <div class="flex flex-col items-center">
                        <h3 class="text-3xl text-black font-bold">{{ $item->nom_parroquia}}</h3>
                        <p class=" text-lg font-bold">{{ $item->lugar}}</p>
                    </div>
                    <div class="flex flex-col pl-8">
                        <p class="pt-3 text-sm">{{ $item->dir_parroquia}}</p>
                        <p class=" text-sm">{{ $item->telefono}}</p>
                    </div>
                    <div class="pt-3 flex gap-2 justify-end pr-8 pb-3">
                        <a href="{{ route('parroquias.edit', $item->id) }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="document.getElementById('confirmModal{{ $item->id }}').classList.remove('hidden')" class="cursor-pointer text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                        @include('partials.confirmar', [
                            'id' => 'confirmModal' . $item->id,
                            'action' => route('parroquias.destroy', $item->id),
                            'method' => 'DELETE',
                            'title' => 'Eliminar Parroquia',
                            'message' => '¿Estás seguro de eliminar?',
                            'buttonText' => 'Eliminar'
                                ])
                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td class="text-center pt-5" colspan="7">No hay datos en la tabla...</td>
            </tr>
        @endforelse
        </div>
</div>
@endsection