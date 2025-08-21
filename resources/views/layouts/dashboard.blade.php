<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Blanco con Header</title>
  @vite('resources/css/app.css')
  @vite('resources/js/sidebar.js')
  @include('partials.alertas')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Íconos -->
</head>
<body class="bg-times-bg flex font-sans">
  
  <!-- Sidebar -->
  <aside id="sidebar" class="bg-gray-900 border-r text-gray-300  h-screen transition-all duration-300 w-58 shadow-sm flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-between mb-6 p-4">
      <span class="text-lg font-semibold sidebar-text tracking-wide">Panel del Admin</span>
      <button id="toggleBtn" class="p-2 rounded hover:bg-gray-700 cursor-pointer">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
    

    <!-- Menú principal -->
    <nav class="flex-1 overflow-y-auto">
      <!-- Sección: Menu -->
      <div class="mb-6">
        <h2 class="sidebar-text text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-2">menu</h2>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="{{ route('principal') }}" class="flex items-center gap-3 p-2 pl-7  hover:bg-gray-700 transition">
              <i class="fa-solid fa-house"></i>
              <span class="sidebar-text">Principal</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- Sección: Reportes -->
      <div class="mb-6">
        <h2 class="sidebar-text text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-2">administración</h2>
        <ul class="space-y-2 text-sm">
          <li>
            <a href="{{ route('personas.index') }}" class="flex items-center gap-3 p-2 pl-7  hover:bg-gray-700 transition">
              <i class="fa-solid fa-people-group"></i>
              <span class="sidebar-text">Personas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('sacerdotes.index') }}" class="flex items-center gap-3 p-2 pl-7 hover:bg-gray-700 transition">
              <i class="fa-solid fa-user-nurse"></i>
              <span class="sidebar-text">Sacerdotes</span>
            </a>
          </li>
          <li>
            <a href="{{ route('parroquias.index') }}" class="flex items-center gap-3 p-2 pl-7 hover:bg-gray-700 transition">
              <i class="fa-solid fa-place-of-worship"></i>
              <span class="sidebar-text">Parroquias</span>
            </a>
          </li>
          <li>
            <a href="{{ route('ceremonias.index') }}" class="flex items-center gap-3 p-2 pl-7 hover:bg-gray-700 transition">
              <i class="fa-solid fa-book-bible"></i>
              <span class="sidebar-text">Misas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('comprobantes.index') }}" class="flex items-center gap-3 p-2 pl-7 hover:bg-gray-700 transition">
              <i class="fa-solid fa-receipt"></i>
              <span class="sidebar-text">Comprobantes</span>
            </a>
          </li>
          <li>
            <button id="reportsBtn" class="flex items-center justify-between w-full p-2 pl-7 hover:bg-gray-700 transition">
              <div class="flex items-center gap-3">
                <i class="fa-solid fa-people-group"></i>
                <span class="sidebar-text">Reportes</span>
              </div>
              <i class="fa-regular fa-square-caret-right"></i>
            </button>
            <ul id="reportsMenu" class="mt-2 ml-10 space-y-1 hidden">
              <li><a href="#" class="block p-2 rounded hover:bg-gray-100">Reporte 1</a></li>
              <li><a href="#" class="block p-2 rounded hover:bg-gray-100">Reporte 2</a></li>
              <li><a href="#" class="block p-2 rounded hover:bg-gray-100">Reporte 3</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </aside>


  <!-- Contenedor principal -->
  <div class="flex-1 flex flex-col">

    <!-- Header superior -->
    <header class="bg-white border-b border-gray-200 shadow-sm px-4 py-2 flex justify-between items-center">
      <h1 class="text-base font-semibold text-gray-800">Dashboard</h1>

      <!-- Menú de usuario -->
      <div class="relative">
        <button id="userMenuBtn" class="flex items-center gap-2 p-2 rounded hover:bg-gray-100">
          <img src="https://i.pravatar.cc/40" alt="Usuario" class="w-8 h-8 rounded-full">
          <span class="hidden md:inline text-sm font-medium text-gray-700">Admin</span>
          <i class="fa-regular fa-square-caret-right"></i>
        </button>

        <!-- Dropdown -->
        <div id="userMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200">
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver perfil</a>
          <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
        </div>
      </div>
    </header>

    <!-- Contenido -->
    <main class="flex-1 p-6">
      @yield('contenido')
    </main>
  </div>
</body>
</html>

