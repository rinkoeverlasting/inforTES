<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Albertus Reno Aditama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="animate-gradient-bg min-h-screen">
    <!-- Navbar -->
    <nav x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-dark-black/90 border-b border-neon-blue shadow-neon-blue' : 'bg-transparent'"
        class="fixed w-full z-50 transition-all duration-300 py-4 px-6 md:px-12 flex justify-between items-center">
        <a href="/" class="text-2xl font-orbitron font-bold neon-text-blue">PORTFOLIO</a>
        <div class="space-x-8 hidden md:flex font-orbitron">
            <a href="/" class="hover:text-neon-blue transition-colors duration-300 {{ Request::is('/') ? 'neon-text-blue' : '' }}">Home</a>
            <a href="/projects" class="hover:text-neon-purple transition-colors duration-300 {{ Request::is('projects') ? 'neon-text-purple' : '' }}">Skills & Projects</a>
        </div>
        <button class="md:hidden text-white">
            <i data-lucide="menu"></i>
        </button>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-black border-t border-white/10 py-12 px-6 md:px-12 mt-20">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="mb-8 md:mb-0">
                <h2 class="text-2xl font-orbitron font-bold neon-text-purple">RENO ADITAMA</h2>
                <p class="text-gray-500 mt-2">© 2026 All Rights Reserved.</p>
            </div>
            <div class="flex space-x-6">
                <a href="https://instagram.com/reno_aditamaaa" target="_blank" class="hover:neon-text-blue transition-all duration-300">
                    <i data-lucide="instagram" class="w-8 h-8"></i>
                </a>
                <a href="https://wa.me/0878797471192" target="_blank" class="hover:neon-text-purple transition-all duration-300">
                    <i data-lucide="message-circle" class="w-8 h-8"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Fade in on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
    </script>
    @stack('scripts')
</body>
</html>
