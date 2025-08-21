@extends('layouts.dashboard')
@vite('resources/js/form.js')
@section('contenido')
<div class="fixed inset-0 bg-transparent backdrop-blur-sm flex items-center justify-center z-50"> <!-- backdrop-blur-sm: agregar para que sea opaco -->
    <div class="container mx-auto p-4 flex justify-center">
        <div class="bg-white rounded-lg shadow-lg p-2 md:p-4 w-4xl">
            <a href="{{ route('comprobantes.index') }}" class="text-times-azul hover:text-times-hazul mb-4"><i class="fa-solid fa-arrow-left"></i> Volver</a>
            <h1 class="text-3xl font-bold text-center mb-4">Actualizar comprobante</h1>

            <!-- Progress Bar -->
            <div class="flex justify-center">
                <div class="mb-8 w-2xl">
                    <div class="flex justify-between mb-2">
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-times-hazul" id="step1">
                            Información del comprobante
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
            <form action="{{ route('comprobantes.update', $comprobante->id) }}" id="multi-step-form" method="POST">
                @csrf
                @method('PUT')
                <!-- Step 1 -->
                <div id="step-1" class="step grid grid-cols-[30%_67%] gap-4">
                    <div>
                        <input value="id" type="text" id="persona_id" name="persona_id" class="hidden">
                        <div class="mb-6">
                            <label for="documento" class="block mb-2 text-sm font-medium text-gray-900">{{ $comprobante->persona->tipos_identificacion->nom_tipo }}</label>
                            <input value="{{ $comprobante->persona->num_identificacion }}" type="text" id="dni" name="dni" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none cursor-not-allowed w-full p-2" required readonly>
                        </div>
                        <div class="mb-6">
                            <label for="monto" class="block mb-2 text-sm font-medium text-gray-900">Monto</label>
                            <input value="{{ $comprobante->monto }}" type="text" id="monto" name="monto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                        </div>
                        <div class="mb-6">
                            <label for="fec_pago" class="block mb-2 text-sm font-medium text-gray-900">Fecha</label>
                            <input value="{{ $comprobante->fec_pago }}" type="date" id="fec_pago" name="fec_pago" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none focus:border-times-hazul w-full p-2">
                        </div>
                    </div>
                    <div>
                        <div class="mb-6">
                            <label for="fec_ceremonia" class="block mb-2 text-sm font-medium text-gray-900">Nombres completos</label>
                            <input value="{{ $comprobante->persona->nombres }} {{ $comprobante->persona->apellido1 }} {{ $comprobante->persona->apellido2 }}" type="text" id="fec_ceremonia" name="fec_ceremonia" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded focus:outline-none cursor-not-allowed w-full p-2" required readonly>
                        </div>
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