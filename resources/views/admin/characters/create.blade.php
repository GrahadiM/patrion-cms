<!-- resources/views/admin/characters/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Karakter Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Tambah Karakter Baru</h3>
        <p class="text-sm text-gray-600">Isi form berikut untuk menambahkan karakter baru</p>
    </div>

    <form action="{{ route('characters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Informasi Dasar -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Karakter *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                    <input type="text" name="region" value="{{ old('region') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filosofi</label>
                    <textarea name="philosophy" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('philosophy') }}</textarea>
                </div>
            </div>

            <!-- Statistik -->
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tinggi</label>
                        <input type="text" name="height" value="{{ old('height') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Berat</label>
                        <input type="text" name="weight" value="{{ old('weight') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Artefak</label>
                    <input type="text" name="artifact" value="{{ old('artifact') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kekuatan</label>
                    <input type="text" name="power" value="{{ old('power') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <!-- Asal Usul -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pulau</label>
                    <input type="text" name="island" value="{{ old('island') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Asal</label>
                    <input type="text" name="origin" value="{{ old('origin') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">DNA</label>
                    <input type="text" name="dna" value="{{ old('dna') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attitude</label>
                    <textarea name="attitude" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('attitude') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Karakter</label>
                    <textarea name="character" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('character') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Warna Identitas -->
        <div class="mb-6">
            <h4 class="text-md font-semibold text-gray-800 mb-4">Warna Identitas</h4>
            <div id="colors-container">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Warna (HEX)</label>
                        <input type="text" name="colors[]" placeholder="#FF6B35"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Warna</label>
                        <input type="text" name="color_names[]" placeholder="Jingga"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
            <button type="button" id="add-color" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-plus mr-2"></i> Tambah Warna
            </button>
        </div>

        <!-- File Uploads -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Video</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
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

        <!-- Deskripsi & Status -->
        <div class="mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Lengkap</label>
                <textarea name="description" rows="6"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="draft" class="text-blue-600" checked>
                    <span class="ml-2">Draft</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="status" value="published" class="text-blue-600">
                    <span class="ml-2">Published</span>
                </label>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('characters.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                    Simpan Karakter
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview image upload
    document.getElementById('image').addEventListener('change', function(e) {
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

    document.getElementById('thumbnail').addEventListener('change', function(e) {
        const preview = document.getElementById('thumbnail-preview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    document.getElementById('video').addEventListener('change', function(e) {
        const preview = document.getElementById('video-preview');
        if (this.files && this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            preview.classList.remove('hidden');
        }
    });

    // Add color field
    let colorCount = 1;
    document.getElementById('add-color').addEventListener('click', function() {
        const container = document.getElementById('colors-container');
        const newColor = document.createElement('div');
        newColor.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 mb-4';
        newColor.innerHTML = `
            <div>
                <input type="text" name="colors[]" placeholder="#FF6B35"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-center space-x-2">
                <input type="text" name="color_names[]" placeholder="Jingga"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="button" class="remove-color text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(newColor);

        newColor.querySelector('.remove-color').addEventListener('click', function() {
            container.removeChild(newColor);
        });
    });
});
</script>
@endpush
