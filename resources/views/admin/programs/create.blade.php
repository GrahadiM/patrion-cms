<!-- resources/views/admin/programs/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Program Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Tambah Program Baru</h3>
        <p class="text-sm text-gray-600">Isi form berikut untuk menambahkan program baru</p>
    </div>

    <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data" id="programForm">
        @csrf

        <!-- Basic Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Program *</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Platform *</label>
                    <select name="platform" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Platform</option>
                        <option value="cinema" {{ old('platform') == 'cinema' ? 'selected' : '' }}>Cinema</option>
                        <option value="tv" {{ old('platform') == 'tv' ? 'selected' : '' }}>TV</option>
                        <option value="streaming" {{ old('platform') == 'streaming' ? 'selected' : '' }}>Streaming</option>
                        <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="game" {{ old('platform') == 'game' ? 'selected' : '' }}>Game</option>
                        <option value="ott" {{ old('platform') == 'ott' ? 'selected' : '' }}>OTT</option>
                        <option value="digital" {{ old('platform') == 'digital' ? 'selected' : '' }}>Digital</option>
                        <option value="podcast" {{ old('platform') == 'podcast' ? 'selected' : '' }}>Podcast</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Rilis</label>
                    <input type="text" name="release_date" value="{{ old('release_date') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Q4 2024">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durasi</label>
                    <input type="text" name="duration" value="{{ old('duration') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="120 menit">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <input type="text" name="rating" value="{{ old('rating') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="PG-13">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sutradara</label>
                    <input type="text" name="director" value="{{ old('director') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Abdurrahman GM">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Budget</label>
                    <input type="text" name="budget" value="{{ old('budget') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="$15M">
                </div>
            </div>
        </div>

        <!-- Description & Synopsis -->
        <div class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Film epik live action yang mengangkat mitologi Nusantara...">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sinopsis Lengkap</label>
                    <textarea name="synopsis" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Film ini mengisahkan petualangan epik...">{{ old('synopsis') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Characters Selection -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Karakter yang Terlibat</label>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($characters as $character)
                    <label class="flex items-center space-x-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="checkbox" name="characters[]" value="{{ $character->slug }}"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-700">{{ $character->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Production Details -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Detail Produksi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Studio Produksi</label>
                    <input type="text" name="production[studio]" value="{{ old('production.studio') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Nusantara Cinema">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Timeline Produksi</label>
                    <input type="text" name="production[timeline]" value="{{ old('production.timeline') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="18 months">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Syuting</label>
                    <div id="locations-container">
                        <div class="flex space-x-2 mb-2">
                            <input type="text" name="production[locations][]"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Bali">
                            <button type="button" class="px-4 py-2 text-gray-400 hover:text-gray-600 remove-location hidden">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" id="add-location" class="mt-2 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-plus mr-2"></i> Tambah Lokasi
                    </button>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">VFX Studio</label>
                    <input type="text" name="production[vfx]" value="{{ old('production.vfx') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Industrial Light & Magic">
                </div>
            </div>
        </div>

        <!-- Platforms -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Platform Distribusi</h4>
            <div id="platforms-container">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Platform</label>
                        <input type="text" name="platforms[0][name]"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Cinema 21">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                        <input type="text" name="platforms[0][type]"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="cinema">
                    </div>
                    <div class="flex items-end space-x-2">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                            <input type="text" name="platforms[0][icon]"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="fas fa-film">
                        </div>
                        <button type="button" class="px-4 py-2 text-gray-400 hover:text-gray-600 remove-platform hidden">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-platform" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-plus mr-2"></i> Tambah Platform
            </button>
        </div>

        <!-- File Uploads -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <input type="file" name="thumbnail" id="thumbnail" class="hidden" accept="image/*">
                    <label for="thumbnail" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload thumbnail</p>
                        <p class="text-xs text-gray-500 mt-1">JPEG, PNG, SVG (Max: 2MB)</p>
                    </label>
                    <img id="thumbnail-preview" class="mt-2 mx-auto max-h-40 hidden">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                    <label for="image" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-500 mt-1">JPEG, PNG, SVG (Max: 2MB)</p>
                    </label>
                    <img id="image-preview" class="mt-2 mx-auto max-h-40 hidden">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Trailer</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <input type="file" name="trailer" id="trailer" class="hidden" accept="video/*">
                    <label for="trailer" class="cursor-pointer">
                        <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload trailer</p>
                        <p class="text-xs text-gray-500 mt-1">MP4, MOV, AVI (Max: 10MB)</p>
                    </label>
                    <video id="trailer-preview" controls class="mt-2 mx-auto max-h-40 hidden"></video>
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Galeri</h4>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <input type="file" name="gallery[]" id="gallery" class="hidden" multiple accept="image/*">
                <label for="gallery" class="cursor-pointer">
                    <i class="fas fa-images text-4xl text-gray-400 mb-3"></i>
                    <p class="text-sm text-gray-600">Klik atau drag & drop untuk upload gambar galeri</p>
                    <p class="text-xs text-gray-500 mt-1">Multiple files allowed (Max: 2MB per file)</p>
                </label>
                <div id="gallery-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Episode</label>
                <input type="number" name="episodes" value="{{ old('episodes', 1) }}" min="1"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Views</label>
                <input type="number" name="views" value="{{ old('views', 0) }}" min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('programs.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                Simpan Program
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // File previews
    const previewFile = (inputId, previewId, isVideo = false) => {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        if (input) {
            input.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    if (isVideo) {
                        preview.src = URL.createObjectURL(this.files[0]);
                        preview.classList.remove('hidden');
                    } else {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                }
            });
        }
    };

    previewFile('thumbnail', 'thumbnail-preview');
    previewFile('image', 'image-preview');
    previewFile('trailer', 'trailer-preview', true);

    // Gallery preview
    const galleryInput = document.getElementById('gallery');
    const galleryPreview = document.getElementById('gallery-preview');

    if (galleryInput) {
        galleryInput.addEventListener('change', function(e) {
            galleryPreview.innerHTML = '';
            galleryPreview.classList.remove('hidden');

            Array.from(this.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-32 object-cover rounded-lg';
                        img.alt = `Gallery Image ${index + 1}`;
                        galleryPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    }

    // Add location field
    let locationCount = 1;
    document.getElementById('add-location').addEventListener('click', function() {
        const container = document.getElementById('locations-container');
        const newLocation = document.createElement('div');
        newLocation.className = 'flex space-x-2 mb-2';
        newLocation.innerHTML = `
            <input type="text" name="production[locations][]"
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Lokasi ${locationCount + 1}">
            <button type="button" class="px-4 py-2 text-red-600 hover:text-red-800 remove-location">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newLocation);
        locationCount++;

        // Show remove buttons for all except first
        document.querySelectorAll('.remove-location').forEach(btn => btn.classList.remove('hidden'));
    });

    // Add platform field
    let platformCount = 1;
    document.getElementById('add-platform').addEventListener('click', function() {
        const container = document.getElementById('platforms-container');
        const newPlatform = document.createElement('div');
        newPlatform.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 mb-4';
        newPlatform.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Platform</label>
                <input type="text" name="platforms[${platformCount}][name]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Platform ${platformCount + 1}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                <input type="text" name="platforms[${platformCount}][type]"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="tipe">
            </div>
            <div class="flex items-end space-x-2">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                    <input type="text" name="platforms[${platformCount}][icon]"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="fas fa-globe">
                </div>
                <button type="button" class="px-4 py-2 text-red-600 hover:text-red-800 remove-platform">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newPlatform);
        platformCount++;

        // Show remove buttons for all except first
        document.querySelectorAll('.remove-platform').forEach(btn => btn.classList.remove('hidden'));
    });

    // Remove location/platform
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-location')) {
            const locationField = e.target.closest('.flex.space-x-2');
            if (locationField && document.querySelectorAll('#locations-container .flex.space-x-2').length > 1) {
                locationField.remove();
            }
        }

        if (e.target.closest('.remove-platform')) {
            const platformField = e.target.closest('.grid.grid-cols-1');
            if (platformField && document.querySelectorAll('#platforms-container .grid.grid-cols-1').length > 1) {
                platformField.remove();
            }
        }
    });
});
</script>
@endpush
