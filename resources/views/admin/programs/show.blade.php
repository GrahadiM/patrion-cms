<!-- resources/views/admin/programs/show.blade.php -->
@extends('layouts.app')

@section('title', 'Detail Program: ' . $program->title)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $program->title }}</h3>
                <p class="text-sm text-gray-600">Detail lengkap program</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('programs.edit', $program) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-medium rounded-md hover:bg-yellow-600">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('programs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Basic Info & Thumbnail -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 rounded-lg p-6">
                @if($program->thumbnail)
                    <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}" class="w-full h-auto rounded-lg mb-4">
                @endif

                <div class="space-y-4">
                    <!-- Status Badge -->
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Status</span>
                        @php
                            $statusConfig = [
                                'draft' => ['color' => 'yellow', 'icon' => 'fas fa-pencil-alt'],
                                'upcoming' => ['color' => 'blue', 'icon' => 'fas fa-calendar-alt'],
                                'ongoing' => ['color' => 'green', 'icon' => 'fas fa-play-circle'],
                                'completed' => ['color' => 'gray', 'icon' => 'fas fa-check-circle']
                            ];
                            $config = $statusConfig[$program->status] ?? $statusConfig['draft'];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $config['color'] }}-100 text-{{ $config['color'] }}-800">
                            <i class="{{ $config['icon'] }} mr-2"></i> {{ ucfirst($program->status) }}
                        </span>
                    </div>

                    <!-- Platform Badge -->
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Platform</span>
                        @php
                            $platformConfig = [
                                'cinema' => ['color' => 'purple', 'icon' => 'fas fa-film'],
                                'tv' => ['color' => 'red', 'icon' => 'fas fa-tv'],
                                'streaming' => ['color' => 'blue', 'icon' => 'fas fa-play-circle'],
                                'youtube' => ['color' => 'red', 'icon' => 'fab fa-youtube'],
                                'game' => ['color' => 'green', 'icon' => 'fas fa-gamepad']
                            ];
                            $config = $platformConfig[$program->platform] ?? $platformConfig['streaming'];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $config['color'] }}-100 text-{{ $config['color'] }}-800">
                            <i class="{{ $config['icon'] }} mr-2"></i> {{ ucfirst($program->platform) }}
                        </span>
                    </div>

                    <!-- Basic Info -->
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Tanggal Rilis</span>
                        <span class="text-gray-800">{{ $program->release_date ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Durasi</span>
                        <span class="text-gray-800">{{ $program->duration ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Rating</span>
                        <span class="text-gray-800">{{ $program->rating ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Sutradara</span>
                        <span class="text-gray-800">{{ $program->director ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Budget</span>
                        <span class="text-gray-800">{{ $program->budget ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-gray-50 rounded-lg p-6 mt-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Statistik</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $program->episodes }}</div>
                        <div class="text-sm text-gray-600">Episode</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ number_format($program->views) }}</div>
                        <div class="text-sm text-gray-600">Views</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Details -->
        <div class="lg:col-span-2">

            <!-- Trailer -->
            @if($program->trailer)
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Trailer</h4>
                        <video controls class="w-full rounded-lg" autoplay loop>
                            <source src="{{ asset('storage/' . $program->trailer) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                </div>
            @endif

            <!-- Description & Synopsis -->
            <div class="mb-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Deskripsi Program</h4>
                    <p class="text-gray-700 mb-6">{{ $program->description ?? 'Tidak ada deskripsi.' }}</p>

                    <h4 class="text-md font-semibold text-gray-800 mb-4">Sinopsis</h4>
                    <div class="prose max-w-none">
                        {{ $program->synopsis ?? 'Tidak ada sinopsis.' }}
                    </div>
                </div>
            </div>

            <!-- Characters -->
            @if($program->characters && count($program->characters) > 0)
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Karakter yang Terlibat</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($characterList as $character)
                                <a href="{{ route('characters.show', $character) }}" class="block group">
                                    <div class="bg-white rounded-lg p-4 text-center border border-gray-200 hover:border-blue-500 transition-colors">
                                        @if($character->image)
                                            <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="w-16 h-16 object-cover rounded-full mx-auto mb-2">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div class="font-medium text-gray-800 group-hover:text-blue-600">{{ $character->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $character->region ?? '-' }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Show character slugs if characters not found -->
                        @if($characterList->count() < count($program->characters))
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Karakter berikut tidak ditemukan di database:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(array_diff($program->characters, $characterList->pluck('slug')->toArray()) as $missingChar)
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-sm rounded-full">
                                            {{ $missingChar }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Production Details -->
            @if($program->production && !empty(array_filter($program->production)))
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Detail Produksi</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if(isset($program->production['studio']))
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Studio Produksi</span>
                                    <span class="text-gray-800">{{ $program->production['studio'] }}</span>
                                </div>
                            @endif

                            @if(isset($program->production['timeline']))
                                <div>
                                    <span class="block text-sm font-medium text-gray-500">Timeline Produksi</span>
                                    <span class="text-gray-800">{{ $program->production['timeline'] }}</span>
                                </div>
                            @endif

                            @if(isset($program->production['locations']) && count($program->production['locations']) > 0)
                                <div class="md:col-span-2">
                                    <span class="block text-sm font-medium text-gray-500">Lokasi Syuting</span>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($program->production['locations'] as $location)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">
                                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $location }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(isset($program->production['vfx']))
                                <div class="md:col-span-2">
                                    <span class="block text-sm font-medium text-gray-500">VFX Studio</span>
                                    <span class="text-gray-800">{{ $program->production['vfx'] }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Platforms -->
            @if($program->platforms && count($program->platforms) > 0)
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Platform Distribusi</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($program->platforms as $platform)
                                <div class="flex items-center space-x-3 p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i class="{{ $platform['icon'] ?? 'fas fa-globe' }} text-gray-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $platform['name'] }}</div>
                                        <div class="text-sm text-gray-600">{{ $platform['type'] ?? 'Other' }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Gallery -->
            @if($program->gallery && count($program->gallery) > 0)
                <div class="mb-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Galeri</h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($program->gallery as $image)
                                <a href="{{ asset('storage/' . $image['src']) }}" target="_blank" class="block">
                                    <img src="{{ asset('storage/' . $image['src']) }}"
                                         alt="{{ $image['caption'] ?? 'Gallery Image' }}"
                                         class="w-full h-32 object-cover rounded-lg hover:opacity-90 transition-opacity">
                                    @if(isset($image['caption']))
                                        <div class="text-xs text-gray-600 mt-1 text-center">{{ $image['caption'] }}</div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Activity Log -->
    <div class="mt-8">
        <h4 class="text-md font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h4>
        @if($program->activities->count() > 0)
            <div class="bg-white border border-gray-200 rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perubahan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($program->activities->take(5) as $activity)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $activity->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $activity->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $activity->causer->name ?? 'System' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($activity->properties->count() > 0)
                                            <button class="text-blue-600 hover:text-blue-800 show-changes" data-changes="{{ json_encode($activity->properties) }}">
                                                Lihat perubahan
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p class="text-gray-500">Belum ada aktivitas untuk program ini.</p>
        @endif
    </div>
</div>

<!-- Modal for changes -->
<div id="changesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Detail Perubahan</h3>
            <button onclick="closeChangesModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="changesContent" class="max-h-96 overflow-y-auto">
            <!-- Changes will be loaded here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showChanges(changes) {
    const content = document.getElementById('changesContent');
    let html = '<div class="space-y-4">';

    if (changes.attributes) {
        html += '<div><h4 class="font-semibold text-gray-700 mb-2">Atribut:</h4>';
        html += '<pre class="bg-gray-100 p-4 rounded text-sm">' + JSON.stringify(changes.attributes, null, 2) + '</pre></div>';
    }

    if (changes.old) {
        html += '<div><h4 class="font-semibold text-gray-700 mb-2">Sebelum:</h4>';
        html += '<pre class="bg-red-50 p-4 rounded text-sm">' + JSON.stringify(changes.old, null, 2) + '</pre></div>';
    }

    html += '</div>';
    content.innerHTML = html;

    document.getElementById('changesModal').classList.remove('hidden');
}

function closeChangesModal() {
    document.getElementById('changesModal').classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.show-changes').forEach(button => {
        button.addEventListener('click', function() {
            const changes = JSON.parse(this.dataset.changes);
            showChanges(changes);
        });
    });

    // Close modal when clicking outside
    document.getElementById('changesModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeChangesModal();
        }
    });
});
</script>
@endpush
