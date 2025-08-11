@extends('layouts.dashboard')
@section('contenido')
<div class="grid grid-cols-[80%_20%] gap-4">
    <div class="bg-white rounded-bl-2xl rounded-br-2xl">
        <div class="bg-cordes-blue p-0.5"></div>
        <h1 class="text-gray-800 pl-4">Filtrar</h1>
        <form action="#" method="GET">
            <input name="buscar" class="bg-gray-100 p-1 mb-2 ml-7 mt-2 w-5/6 rounded" type="text" placeholder="Nombre, Apellido, número">
            <button class="bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 py-1 mb-2 rounded" type="submit">Buscar</button>
        </form>
    </div>
    <div class="bg-white rounded-bl-2xl rounded-br-2xl">
        <div class="bg-cordes-blue p-0.5"></div>
        <h1 class="text-gray-800 pl-2">Crear</h1>
        <div class="flex flex-col items-center">
            <a href="{{ route('parroquias.create') }}" class=" bg-cordes-blue hover:bg-blue-950 transition-colors duration-200 cursor-pointer text-white px-4 pb-2 pt-1 m-2 rounded">
                Nueva    
            </a>
        </div>
    </div>
    <div class="bg-white rounded-bl-2xl rounded-br-2xl pb-4">
        <div class="bg-cordes-blue p-0.5"></div>
    <div class="grid grid-cols-4 gap-2 pt-8 pl-4">
    @forelse ($parroquia as $item)
        <div class="bg-white hover:shadow-blue-900 hover:shadow-md rounded-lg border">
            <div class="p-1 rounded-t-lg bg-cordes-blue"></div>
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
        
    @endforelse
    </div>
    </div>
    {{-- Estadisticas --}}
    <div class="bg-white rounded-bl-2xl rounded-br-2xl">
        <div class="bg-cordes-blue p-0.5"></div>
        <h1 class="text-gray-800 pl-4 pb-2">Estadisticas</h1>
        <div class="ml-2 mb-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-semibold rounded-full overflow-hidden">
            <div class="px-3 py-1 bg-green-200">Total de parroquias</div>
            <div class="px-3 py-1">{{ $total }}</div>
        </div>
        <br>
    </div>
</div>

@endsection