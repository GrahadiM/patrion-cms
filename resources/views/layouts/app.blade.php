<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Patrion CMS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="hidden md:flex md:w-64 bg-gray-900 text-white flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    {{-- <img src="{{ asset('favicon.ico') }}" alt="Logo" class="w-8 h-8"> --}}
                    <h1 class="text-2xl font-bold">Patrion CMS</h1>
                </div>
            </div>

            <hr class="border-gray-800 pb-4">

            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('characters.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('characters.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Karakter</span>
                </a>

                <a href="{{ route('programs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('programs.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-film"></i>
                    <span>Program</span>
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('users.*') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('activity-logs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 {{ request()->routeIs('activity-log') ? 'bg-gray-800' : '' }}">
                    <i class="fas fa-history"></i>
                    <span>Activity Log</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/images/admin/default-avatar.png') }}"
                         alt="Profile" class="w-10 h-10 rounded-full cursor-pointer" onclick="window.location.href = '{{ route('profile.edit') }}';">
                    <div class="flex-1 cursor-pointer" onclick="window.location.href = '{{ route('profile.edit') }}';">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="md:hidden text-gray-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" class="fixed inset-0 z-50 flex md:hidden" style="display: none;">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="closeSidebar()"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-900 text-white">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        {{-- <img src="{{ asset('favicon.ico') }}" alt="Logo" class="w-8 h-8"> --}}
                        <h1 class="text-2xl font-bold">Patrion CMS</h1>
                    </div>
                    <button onclick="closeSidebar()" class="text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <hr class="border-gray-800 pb-4">

            <nav class="flex-1 px-4 space-y-2">
                <!-- Same navigation links as desktop -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('characters.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-users"></i>
                    <span>Karakter</span>
                </a>

                <a href="{{ route('programs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-film"></i>
                    <span>Program</span>
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-user-cog"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('activity-logs.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-history"></i>
                    <span>Activity Log</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <!-- Same user profile as desktop -->
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/images/admin/default-avatar.png') }}"
                         alt="Profile" class="w-10 h-10 rounded-full cursor-pointer" onclick="window.location.href = '{{ route('profile.edit') }}';">
                    <div class="flex-1 cursor-pointer" onclick="window.location.href = '{{ route('profile.edit') }}';">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('mobileSidebar').style.display = 'flex';
        });

        function closeSidebar() {
            document.getElementById('mobileSidebar').style.display = 'none';
        }

        // SweetAlert delete confirmation
        function confirmDelete(formId, name) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Karakter "${name}" akan dihapus permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')

</body>
</html>
