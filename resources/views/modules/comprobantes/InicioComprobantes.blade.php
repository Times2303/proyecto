@extends('layouts.dashboard')
@section('contenido')
<a href="{{ route('comprobantes.seleccionar') }}" class="bg-times-verde hover:bg-times-hverde transition-colors duration-200 rounded cursor-pointer text-white px-4 py-2">
    Nuevo comprobante
</a>
{{--card--}}
<div class="shadow-lg">
    {{--header--}}
    <div class="mt-5 bg-white p-3 pl-5 rounded font-sans">
        <h2>Lista de Comprobantes</h2>
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
    {{--Tabla--}}
    <div class="overflow-x-auto px-4 pb-4">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">fecha de emisión</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">monto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento de identidad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($comprobantes as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $item->numero_comprobante }}</td>
                    <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">
                        {{ \Carbon\Carbon::parse($item->fec_pago)->translatedFormat('j \d\e F \d\e\l Y') }}
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap text-sm font-semibold text-gray-900">S/. {{ number_format($item->monto, 2) }}</td>
                    <td class="px-2 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $item->persona->tipos_identificacion->nom_tipo }}</div>
                                <div class="text-sm text-gray-500">{{ $item->persona->num_identificacion }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="#" class="text-times-azul hover:text-times-hazul cursor-pointer">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('comprobantes.edit', $item->id) }}" class="text-gray-600 hover:text-gray-900 cursor-pointer">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" onclick="document.getElementById('confirmModal{{ $item->id }}').classList.remove('hidden')" class="text-times-red hover:text-times-hred cursor-pointer">
                                <i class="fas fa-trash"></i>
                            </button>
                            @include('partials.confirmar', [
                                'id' => 'confirmModal' . $item->id,
                                'action' => route('comprobantes.destroy', $item->id),
                                'method' => 'DELETE',
                                'title' => 'Eliminar comprobante',
                                'message' => '¿Estás seguro de eliminar este comprobante?'. $item->numero_comprobante,
                                'buttonText' => 'Eliminar'
                            ])
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay comprobantes registradas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection