@extends('layouts.app')

@section('title', 'Detail Karakter: ' . $character->name)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $character->name }}</h3>
                <p class="text-sm text-gray-600">Detail lengkap karakter</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('characters.edit', $character) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-medium rounded-md hover:bg-yellow-600">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('characters.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Image & Basic Info -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 rounded-lg p-6">
                @if($character->image)
                    <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="w-full h-auto rounded-lg mb-4">
                @endif

                <div class="space-y-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Status</span>
                        @if($character->status == 'published')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-2"></i> Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-pencil-alt mr-2"></i> Draft
                            </span>
                        @endif
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Region</span>
                        <span class="text-gray-800">{{ $character->region ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Full Name</span>
                        <span class="text-gray-800">{{ $character->full_name ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Philosophy</span>
                        <p class="text-gray-800 italic">{{ $character->philosophy ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Warna Identitas -->
            @if($character->colors && $character->color_names)
                <div class="bg-gray-50 rounded-lg p-6 mt-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Warna Identitas</h4>
                    <div class="space-y-3">
                        @foreach($character->colors as $index => $color)
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full border border-gray-300" style="background-color: {{ $color }}"></div>
                                <div>
                                    <div class="font-medium">{{ $character->color_names[$index] ?? 'Warna ' . ($index + 1) }}</div>
                                    <div class="text-sm text-gray-500">{{ $color }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Details -->
        <div class="lg:col-span-2">
            <!-- Video Preview -->
            @if($character->video)
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Video Karakter</h4>
                    <video controls class="w-full rounded-lg" autoplay loop>
                        <source src="{{ asset('storage/' . $character->video) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>
            @endif

            <!-- Character Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Physical Stats -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Statistik Fisik</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tinggi</span>
                            <span class="font-medium">{{ $character->height ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Berat</span>
                            <span class="font-medium">{{ $character->weight ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Powers -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Kekuatan & Artefak</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="block text-sm text-gray-600">Artefak</span>
                            <span class="font-medium">{{ $character->artifact ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-600">Kekuatan</span>
                            <span class="font-medium">{{ $character->power ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Origin -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Asal Usul</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="block text-sm text-gray-600">Pulau</span>
                            <span class="font-medium">{{ $character->island ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-600">Asal</span>
                            <span class="font-medium">{{ $character->origin ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-600">DNA</span>
                            <span class="font-medium">{{ $character->dna ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Character Traits -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Sifat Karakter</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="block text-sm text-gray-600">Attitude</span>
                            <p class="text-gray-800">{{ $character->attitude ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="block text-sm text-gray-600">Karakter</span>
                            <p class="text-gray-800">{{ $character->character ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-gray-50 rounded-lg p-6 mt-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Deskripsi Lengkap</h4>
                <div class="prose max-w-none">
                    {{ $character->description ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Log -->
    <div class="mt-8">
        <h4 class="text-md font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h4>
        @if($character->activities->count() > 0)
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
                            @foreach($character->activities->take(5) as $activity)
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
            <p class="text-gray-500">Belum ada aktivitas untuk karakter ini.</p>
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
