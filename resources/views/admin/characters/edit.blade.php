@extends('layouts.app')

@section('title', 'Edit Karakter: ' . $character->name)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Edit Karakter: {{ $character->name }}</h3>
                <p class="text-sm text-gray-600">Perbarui informasi karakter</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($character->image)
                    <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="w-16 h-16 object-cover rounded">
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('characters.update', $character) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Informasi Dasar -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Karakter *</label>
                    <input type="text" name="name" value="{{ old('name', $character->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $character->full_name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                    <input type="text" name="region" value="{{ old('region', $character->region) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filosofi</label>
                    <textarea name="philosophy" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('philosophy', $character->philosophy) }}</textarea>
                </div>
            </div>

            <!-- Statistik -->
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi</label>
                        <input type="text" name="height" value="{{ old('height', $character->height) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Berat</label>
                        <input type="text" name="weight" value="{{ old('weight', $character->weight) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Artefak</label>
                    <input type="text" name="artifact" value="{{ old('artifact', $character->artifact) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kekuatan</label>
                    <input type="text" name="power" value="{{ old('power', $character->power) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Asal Usul -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pulau</label>
                    <input type="text" name="island" value="{{ old('island', $character->island) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Asal</label>
                    <input type="text" name="origin" value="{{ old('origin', $character->origin) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">DNA</label>
                    <input type="text" name="dna" value="{{ old('dna', $character->dna) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attitude</label>
                    <textarea name="attitude" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('attitude', $character->attitude) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Karakter</label>
                    <textarea name="character" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('character', $character->character) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Warna Identitas -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Warna Identitas</h4>
            <div id="colors-container">
                @if($character->colors && $character->color_names)
                    @foreach($character->colors as $index => $color)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Warna (HEX)</label>
                                <input type="text" name="colors[]" value="{{ $color }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warna</label>
                                    <input type="text" name="color_names[]" value="{{ $character->color_names[$index] ?? '' }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                @if($loop->first)
                                    <div class="mt-6">
                                        <button type="button" class="add-color text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="mt-6">
                                        <button type="button" class="remove-color text-red-600 hover:text-red-800">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Template awal jika tidak ada warna -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Warna (HEX)</label>
                            <input type="text" name="colors[]" placeholder="#FF6B35"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warna</label>
                                <input type="text" name="color_names[]" placeholder="Jingga"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="mt-6">
                                <button type="button" class="add-color text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- File Uploads dengan preview existing -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    @if($character->image)
                        <img src="{{ asset('storage/' . $character->image) }}" class="mb-2 mx-auto max-h-40">
                    @endif
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                    <label for="image" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload gambar baru</p>
                        <p class="text-xs text-gray-500 mt-1">JPEG, PNG, SVG (Max: 2MB)</p>
                    </label>
                    <img id="image-preview" class="mt-2 mx-auto max-h-40 hidden">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Thumbnail</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    @if($character->image)
                        <img src="{{ asset('storage/' . $character->image) }}" class="mb-2 mx-auto max-h-40">
                    @endif
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Video</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    @if($character->video)
                        <video controls class="w-full rounded-lg">
                            <source src="{{ asset('storage/' . $character->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    @endif
                    <input type="file" name="video" id="video" class="hidden" accept="video/*">
                    <label for="video" class="cursor-pointer">
                        <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload video</p>
                        <p class="text-xs text-gray-500 mt-1">MP4, MOV, AVI (Max: 10MB)</p>
                    </label>
                    <video id="video-preview" controls class="mt-2 mx-auto max-h-40 hidden"></video>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="draft" class="text-blue-600" {{ $character->status == 'draft' ? 'checked' : '' }}>
                    <span class="ml-2">Draft</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="published" class="text-blue-600" {{ $character->status == 'published' ? 'checked' : '' }}>
                    <span class="ml-2">Published</span>
                </label>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('characters.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                    Update Karakter
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Script untuk menambah/menghapus field warna
document.addEventListener('DOMContentLoaded', function() {
    // Tambah warna
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-color')) {
            const container = document.getElementById('colors-container');
            const newColor = document.createElement('div');
            newColor.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 mb-4';
            newColor.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warna (HEX)</label>
                    <input type="text" name="colors[]" placeholder="#FF6B35"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center space-x-2">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warna</label>
                        <input type="text" name="color_names[]" placeholder="Jingga"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="mt-6">
                        <button type="button" class="remove-color text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newColor);
        }

        // Hapus warna
        if (e.target.closest('.remove-color')) {
            const colorField = e.target.closest('.grid');
            if (colorField && document.querySelectorAll('#colors-container .grid').length > 1) {
                colorField.remove();
            }
        }
    });

    // Preview image upload
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
@endpush
