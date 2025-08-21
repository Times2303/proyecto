@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
<div class="fixed inset-0 bg-transparent backdrop-blur-sm flex items-center justify-center z-50"> <!-- backdrop-blur-sm: agregar para que sea opaco -->
    <div class="container mx-auto p-4 flex justify-center">
    <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-4xl">
        <a href="{{ route('ceremonias.index') }}" class="text-times-azul hover:text-times-hazul mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Registrar ceremonia</h1>

        <!-- Progress Bar -->
        <div class="flex justify-center">
            <div class="mb-8 w-2xl">
                <div class="flex justify-between mb-2">
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-times-hazul" id="step1">
                                Datos de la ceremonia
                            </span>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-times-hazul opacity-50" id="step2">
                                comentarios
                            </span>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-times-celeste">
                <div id="progress-bar"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-times-hazul w-1/2 transition-all duration-500 ease-in-out">
                </div>
                </div>
            </div>
        </div>
        

        <!-- Form Steps -->
        <form action="{{ route('ceremonias.update', $ceremonias->id) }}" id="multi-step-form" method="POST">
            @csrf
            @method('PUT')
            <!-- Step 1 -->
            <div id="step-1" class="step grid grid-cols-[30%_67%] gap-4">
                <div>
                    <div class="mb-6">
                        <label for="tipo_documento" class="block mb-2 text-sm font-medium text-gray-900">Parroquia encargada</label>
                        <select id="parroquia" name="parroquia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                            <option disabled {{ old('parroquia') ? '' : 'selected' }}>Seleccione una opción</option>
                                @foreach ($parroquias as $item1)
                                    <option value="{{ $item1->id }}" {{ $ceremonias->parroquias_id == $item1->id ? 'selected' : '' }}>
                                        {{ $item1->nom_parroquia }} , {{ $item1->lugar }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="fec_ceremonia" class="block mb-2 text-sm font-medium text-gray-900">Fecha de la ceremonia</label>
                        <input value="{{ $ceremonias->fec_ceremonia }}" type="date" id="fec_ceremonia" name="fec_ceremonia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                    </div>
                </div>

                <div>
                    <div class="mb-6">
                        <label for="tipo_documento" class="block mb-2 text-sm font-medium text-gray-900">Sacerdote encargado</label>
                        <select id="sacerdote" name="sacerdote" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                            <option disabled {{ old('sacerdote') ? '' : 'selected' }}>Seleccione una opción</option>
                                @foreach ($sacerdotes as $item2)
                                    <option value="{{ $item2->id }}" {{ $ceremonias->sacerdotes_id == $item2->id ? 'selected' : '' }}>
                                        {{ $item2->personas->nombres }} {{ $item2->personas->apellido1 }} {{ $item2->personas->apellido2 }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            

            <!-- Step 2 -->
            <div id="step-2" class="step hidden">
                <div class="mb-6">
                    <label for="comentario" class="block mb-2 text-sm font-medium text-gray-900">Comentarios</label>
                    <textarea name="comentario" id="comentario" cols="20" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">{{ $ceremonias->comentarios }}</textarea>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between">
                <button type="button" id="prevBtn" class="px-4 py-2 cursor-pointer bg-times-gris text-black rounded hover:bg-times-hgris hidden">Anterior</button>
                <button type="button" id="nextBtn" class="px-4 py-2 cursor-pointer bg-times-azul hover:bg-times-hazul text-white rounded">Siguiente</button>
                <button type="submit" id="submitBtn" class="px-4 py-2 cursor-pointer bg-times-azul text-white rounded hover:bg-times-hazul hidden">Enviar</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection