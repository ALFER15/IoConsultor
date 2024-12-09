<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    @vite('resources/css/app.css') <!-- Importa Tailwind configurado -->
</head>
<body class="bg-red-500 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl bg-zinc-100 text-white p-8 rounded-lg shadow-lg flex flex-col md:flex-row items-center">
        <!-- Texto -->
        <div class="md:w-1/2 space-y-4">
            <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-[#FF2D20] focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-[#FF2D20] dark:focus-visible:ring-[#FF2D20]"
                                        >
                                        Entra a la web
                                    </a>
            <span class="block bg-black text-white px-4 py-1 text-sm font-semibold rounded-full">
                IoConsultor
            </span>
            <div class="bg-black p-4 rounded-lg">
            <h1 class="text-4xl font-extrabold leading-tight">
            ¿Qué es <span class="text-red-400">IoConsultor</span>?
            </h1>
            <br>
            <p class="text-white opacity-80">
                Nuestra pagina de registro para pacientes, doctores, diagnosticos, medicamentos y asignaciones.
            </p>
            <br>
            <br>
            </div>
        </div>
        <!-- Imagen -->
        <div class="md:w-1/2 flex justify-center">
            <img src="https://png.pngtree.com/png-vector/20230929/ourmid/pngtree-indian-doctor-hair-png-image_10130118.png" alt="Persona sonriente" class="rounded-full bg-red-300">
        </div>
    </div>
</body>
</html>
