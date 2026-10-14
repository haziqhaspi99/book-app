<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment Planner</title>
    <!-- Include Tailwind CSS via Laravel Vite Assets or CDN for simple test --> 
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full">
        <!-- Senior Standard: Injecting the livewire form into our main template layer -->
        @livewire('book-appointment-form')
    </div>

    @livewireScripts
</body>
</html>
