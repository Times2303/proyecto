@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
{{--Form con pasos--}}
<div class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="container mx-auto p-4 flex justify-center">
    <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-xl">
        <a href="{{ route('sacerdotes.index') }}" class="text-blue-500 hover:underline mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Actualizar sacerdote</h1>

        <!-- Progress Bar -->
        <div class="flex justify-center">
            <div class="mb-8 w-md">
                <div class="flex justify-between mb-2">
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-700 bg-blue-200" id="step1">
                                Parroquia y Jerarquia
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
        <form action="{{ route('sacerdotes.update', $sacerdote->id) }}" id="multi-step-form" method="POST">
            @csrf
            @method('PUT')
            <!-- Step 1 -->
            <div id="step-1" class="step grid grid-cols-[47%_47%] gap-4">
                <div>
                    <div class="mb-6">
                    <label for="jerarquia" class="block mb-2 text-sm font-medium text-gray-900">Jerarquia</label>
                    <select id="jerarquia" name="jerarquia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                        <option value="" disabled {{ old('nom_jerarquia') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($jerarquia as $item1)
                                <option value="{{ $item1->id }}" {{ $sacerdote->jerarquias_id == $item1->id ? 'selected' : '' }}>
                                    {{ $item1->nom_jerarquia}}
                                </option>
                            @endforeach
                    </select>
                    </div>

                    <div class="mb-6">
                        <label for="parroquia" class="block mb-2 text-sm font-medium text-gray-900">Parroquia</label>
                        <select id="parroquia" name="parroquia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="" disabled {{ old('nom_parroquia') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($parroquia as $item2)
                                <option value="{{ $item2->id }}" {{ $sacerdote->parroquias_id == $item2->id ? 'selected' : '' }}>
                                    {{ $item2->nom_parroquia }} de {{ $item2->lugar }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <div class="mb-6">
                        <label for="fec_inicio" class="block mb-2 text-sm font-medium text-gray-900">Fecha de incorporación</label>
                        <input value="{{ $sacerdote->fec_inicio }}" type="date" id="fec_inicio" name="fec_inicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="fec_fin" class="block mb-2 text-sm font-medium text-gray-900">Fecha de retiro</label>
                        <input value="{{ $sacerdote->fec_fin }}" type="date" id="fec_fin" name="fec_fin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    </div>
                    <input type="hidden" name="persona_id" value="{{ request()->query('persona_id') }}">
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