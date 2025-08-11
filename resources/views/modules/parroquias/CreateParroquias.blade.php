@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
{{--Form con pasos--}}
<div class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="container mx-auto p-4 flex justify-center">
    <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-xl">
        <a href="{{ route('parroquias.index') }}" class="text-blue-500 hover:underline mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Registrar nueva parroquia</h1>

        <!-- Progress Bar -->
        <div class="flex justify-center">
            <div class="mb-8 w-md">
                <div class="flex justify-between mb-2">
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-700 bg-blue-200" id="step1">
                    datos de la parroquia
                </span>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200 ">
                <div id="progress-bar"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-cordes-blue w-1/3 transition-all duration-500 ease-in-out">
                </div>
                </div>
            </div>
        </div>
        

        <!-- Form Steps -->
        <form action="{{ route('parroquias.store') }}" id="multi-step-form" method="POST">
            @csrf
            <!-- Step 1 -->
            <div id="step-1" class="step grid grid-cols-[47%_47%] gap-4">
                <div>
                    <div class="mb-6">
                        <label for="nom_parroquia" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input value="{{ old('nom_parroquia') }}" type="text" id="nom_parroquia" name="nom_parroquia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="dir_parroquia" class="block mb-2 text-sm font-medium text-gray-900">Dirección</label>
                        <input value="{{ old('dir_parroquia') }}" type="text" id="dir_parroquia" name="dir_parroquia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                </div>
                <div>
                    
                    <div class="mb-6">
                        <label for="lugar" class="block mb-2 text-sm font-medium text-gray-900">Lugar</label>
                        <input value="{{ old('lugar') }}" type="text" id="lugar" name="lugar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    </div>
                    <div class="mb-6">
                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900">Telefono</label>
                        <input value="{{ old('telefono') }}" type="text" id="telefono" name="telefono" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    </div>
                </div>
            </div>
            <!-- Navigation Buttons -->
            <div class="flex justify-between">
            <button type="button" id="prevBtn" class="px-4 py-2 cursor-pointer bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 focus:outline-none focus:shadow-outline hidden">Anterior</button>
            <button type="button" id="nextBtn" class="px-4 py-2 cursor-pointer bg-cordes-blue text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:shadow-outline">Siguiente</button>
            <button type="submit" id="submitBtn" class="px-4 py-2 cursor-pointer bg-cordes-blue text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:shadow-outline hidden">Enviar</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection