<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warung Gorengan - Sistem Kasir POS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #a7f3d0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #6ee7b7; }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes pulse-green {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        @keyframes bellRing {
            0%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(10deg); }
            20%, 40% { transform: rotate(-10deg); }
            50% { transform: rotate(0deg); }
        }

        .animate-fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
        .animate-slide-left { animation: slideInLeft 0.5s ease-out forwards; }
        .animate-slide-right { animation: slideInRight 0.5s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.4s ease-out forwards; }
        .animate-pulse-green { animation: pulse-green 2s infinite; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-bell { animation: bellRing 1s ease-in-out; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Sidebar active indicator */
        .sidebar-link.active {
            background: linear-gradient(135deg, #dcfce7, #bbf7d0);
            color: #166534;
            font-weight: 600;
            border-right: 3px solid #16a34a;
        }
        .sidebar-link {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-link:hover {
            background: #f0fdf4;
            color: #166534;
            transform: translateX(4px);
        }

        /* Card hover */
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.1);
        }

        /* Product list item */
        .product-item {
            transition: all 0.2s ease;
        }
        .product-item:hover {
            background: #f0fdf4;
            transform: translateX(4px);
        }

        /* FAB button */
        .fab-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .fab-btn:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64">

            {{-- Navbar --}}
            @include('layouts.navigation')

            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="px-4 sm:px-6 lg:px-8 py-6 lg:py-8 space-y-6">
                    @if (isset($slot))
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endif
                </div>
            </main>

        </div>
    </div>

    {{-- FAB Button --}}
    <button class="fab-btn fixed bottom-6 right-6 w-14 h-14 bg-green-600 hover:bg-green-700 text-white rounded-full shadow-lg flex items-center justify-center z-50 animate-pulse-green" title="Bantuan">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </button>

    {{-- Sidebar Overlay (Mobile) --}}
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/40 z-30 hidden lg:hidden opacity-0" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        // Bell notification animation on load
        document.addEventListener('DOMContentLoaded', () => {
            const bell = document.getElementById('bellIcon');
            if (bell) {
                setTimeout(() => bell.classList.add('animate-bell'), 1000);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
