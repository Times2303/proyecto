@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
{{--Form con pasos--}}
<div class="fixed inset-0 bg-opacity-0 backdrop-blur-sm flex items-center justify-center z-50">
<div class="container mx-auto p-4 flex justify-center">
    <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-4xl">
        <a href="{{ route('personas.index') }}" class="text-times-azul hover:text-times-hazul mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Actualizar persona</h1>

        <!-- Progress Bar -->
        <div class="flex justify-center">
            <div class="mb-8 w-2xl">
                <div class="flex justify-between mb-2">
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-times-hazul" id="step1">
                                Datos personales {{--tipo, numero, nacionalidad--}}
                            </span>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-times-hazul opacity-50" id="step2">
                                Datos de contacto {{--nombres, apellidos, fecha de nacimiento--}}
                            </span>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-times-celeste">
                <div id="progress-bar"
                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-times-azul w-1/3 transition-all duration-500 ease-in-out">
                </div>
                </div>
            </div>
        </div>
        

        <!-- Form Steps -->
        <form action="{{ route('personas.update', $persona->id) }}" id="multi-step-form" method="POST">
            @csrf
            @method('PUT')
            <!-- Step 1 -->
            <div id="step-1" class="step grid grid-cols-[30%_67%] gap-4">
                <div class="">
                    <div class="mb-6">
                    <label for="tipo_documento" class="block mb-2 text-sm font-medium text-gray-900">Tipo de documento de identidad</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" id="tipo_identificacion" name="tipo_identificacion">
                        <option value="" disabled {{ old('tipo_identificacion') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($tiposidentificaciones as $tipo)
                                <option value="{{ $tipo->id }}" {{ $persona->tipo_identificacion_id == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nom_tipo }}
                                </option>
                            @endforeach
                    </select>
                    </div>
                    <div class="mb-6">
                        <label for="num_identificacion" class="block mb-2 text-sm font-medium text-gray-900">Número de documento de identidad</label>
                        <input type="text" id="num_identificacion" name="num_identificacion" value="{{ $persona->num_identificacion }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="nacionalidad" class="block mb-2 text-sm font-medium text-gray-900">Nacionalidad</label>
                        <select id="nacionalidad" name="nacionalidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                            <option value="" disabled {{ old('nacionalidad') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($nacionalidades as $nacionalidad)
                                <option value="{{ $nacionalidad->id }}" {{ $persona->nacionalidad_id == $nacionalidad->id ? 'selected' : '' }}>
                                    {{ $nacionalidad->nom_nacionalidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="fecha_nacimiento" class="block mb-2 text-sm font-medium text-gray-900">Fecha de nacimiento</label>
                        <input value="{{ $persona->fecha_nacimiento }}" type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="mb-6">
                        <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900">Nombres</label>
                        <input value="{{ $persona->nombres }}" type="text" id="nombres" name="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="apellido1" class="block mb-2 text-sm font-medium text-gray-900">Apellido paterno</label>
                        <input value="{{ $persona->apellido1 }}" type="text" id="apellido1" name="apellido1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="apellido2" class="block mb-2 text-sm font-medium text-gray-900">Apellido materno</label>
                        <input value="{{ $persona->apellido2 }}" type="text" id="apellido2" name="apellido2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                    </div>
                </div>
            </div>
            

            <!-- Step 2 -->
            <div id="step-2" class="step hidden">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input value="{{ $persona->email }}" type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                </div>
                <div class="mb-6">
                    <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">Dirección de su hogar</label>
                    <input value="{{ $persona->direccion }}" type="text" id="direccion" name="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
                </div>
                <div class="mb-6">
                    <label for="celular" class="block mb-2 text-sm font-medium text-gray-900">Celular</label>
                    <input value="{{ $persona->celular }}" type="text" id="celular" name="celular" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2" required>
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