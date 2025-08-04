@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
{{--Form con pasos--}}
<div class="container mx-auto p-4 flex justify-center">
    <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-4xl">
        <a href="{{ route('personas.index') }}" class="text-blue-500 hover:underline mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
        <h1 class="text-3xl font-bold text-center mb-4">Registrar nueva persona</h1>

        <!-- Progress Bar -->
        <div class="flex justify-center">
            <div class="mb-8 w-2xl">
                <div class="flex justify-between mb-2">
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-700 bg-blue-200" id="step1">
                                Datos personales {{--tipo, numero, nacionalidad--}}
                            </span>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-700 bg-blue-200 opacity-50" id="step2">
                                Datos de contacto {{--nombres, apellidos, fecha de nacimiento--}}
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
        <form action="{{ route('personas.store') }}" id="multi-step-form" method="POST">
            @csrf
            <!-- Step 1 -->
            <div id="step-1" class="step grid grid-cols-[30%_67%] gap-4">
                <div class="">
                    <div class="mb-6">
                    <label for="tipo_documento" class="block mb-2 text-sm font-medium text-gray-900">Tipo de documento de identidad</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" id="tipo_identificacion" name="tipo_identificacion">
                        <option value="" disabled {{ old('tipo_identificacion') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($tiposidentificaciones as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old('tipo_identificacion') == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->nom_tipo }}
                                </option>
                            @endforeach
                    </select>
                    </div>
                    <div class="mb-6">
                        <label for="num_identificacion" class="block mb-2 text-sm font-medium text-gray-900">Número de documento de identidad</label>
                        <input type="text" id="num_identificacion" name="num_identificacion" value="{{ old('num_identificacion') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="nacionalidad" class="block mb-2 text-sm font-medium text-gray-900">Nacionalidad</label>
                        <select id="nacionalidad" name="nacionalidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option value="" disabled {{ old('nacionalidad') ? '' : 'selected' }}>Seleccione una opción</option>
                            @foreach ($nacionalidades as $nacionalidad)
                                <option value="{{ $nacionalidad->id }}"
                                    {{ old('nacionalidad') == $nacionalidad->id ? 'selected' : '' }}>
                                    {{ $nacionalidad->nom_nacionalidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="fecha_nacimiento" class="block mb-2 text-sm font-medium text-gray-900">Fecha de nacimiento</label>
                        <input value="{{ old('fecha_nacimiento') }}" type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="mb-6">
                        <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900">Nombres</label>
                        <input value="{{ old('nombres') }}" type="text" id="nombres" name="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="apellido1" class="block mb-2 text-sm font-medium text-gray-900">Apellido paterno</label>
                        <input value="{{ old('apellido1') }}" type="text" id="apellido1" name="apellido1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                    </div>
                    <div class="mb-6">
                        <label for="apellido2" class="block mb-2 text-sm font-medium text-gray-900">Apellido materno</label>
                        <input value="{{ old('apellido2') }}" type="text" id="apellido2" name="apellido2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2">
                    </div>
                </div>
            </div>
            

            <!-- Step 2 -->
            <div id="step-2" class="step hidden">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input value="{{ old('email') }}" type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                </div>
                <div class="mb-6">
                    <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900">Dirección de su hogar</label>
                    <input value="{{ old('direccion') }}" type="text" id="direccion" name="direccion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
                </div>
                <div class="mb-6">
                    <label for="celular" class="block mb-2 text-sm font-medium text-gray-900">Celular</label>
                    <input value="{{ old('celular') }}" type="text" id="celular" name="celular" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2" required>
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


{{-- Form simple 
    <div class="mt-4 mx-auto relative pt-4 pl-10 pr-10 bg-white rounded-2xl shadow-lg w-full max-w-5xl">
        <!-- Decorative Background -->
        <div class="absolute inset-0 -z-10 transform rotate-3 bg-cordes-blue rounded-2xl"></div>

        <h2 class="text-base font-semibold text-gray-800 mb-1">
            <span class="text-cordes-blue font-bold">Complete</span> los campos obligatorios (*), lo demás se puede actualizar después
        </h2>

        <form class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6">
                <!-- Columna Izquierda: Datos personales -->
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium text-gray-800">Tipo de documento*</label>
                        <input type="text" placeholder="Escriba el tipo de documento" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Número de Documento*</label>
                        <input type="number" placeholder="Escriba su número de documento" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Nacionalidad*</label>
                        <input type="text" placeholder="Escriba su nacionalidad" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Nombres*</label>
                        <input type="text" placeholder="Escriba sus nombres" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Apellido Paterno*</label>
                        <input type="text" placeholder="Escriba su apellido paterno" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Apellido Materno*</label>
                        <input type="text" placeholder="Escriba su apellido materno" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Fecha de Nacimiento*</label>
                        <input type="date" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- Columna Derecha: Contacto -->
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium text-gray-800">Dirección</label>
                        <input type="text" placeholder="Ingrese su dirección" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Celular</label>
                        <input type="number" placeholder="Ingrese su número de celular" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-medium text-gray-800">Email*</label>
                        <input type="email" placeholder="Ingrese su correo electrónico" class="w-full mt-1 p-2 border rounded-md bg-gray-100 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4 pt-71">
                        <a href="{{ route('personas.index') }}" class="w-full text-center p-2 text-white bg-gray-700 rounded-md hover:bg-gray-800 transition">
                            Cancelar
                        </a>
                        <button type="submit" class="w-full p-2 text-white bg-cordes-blue rounded-md hover:bg-blue-950 transition cursor-pointer">
                            Crear Persona
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}
@endsection