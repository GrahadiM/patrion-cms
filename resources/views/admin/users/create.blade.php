@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Tambah User Baru</h3>
        <p class="text-sm text-gray-600">Isi form berikut untuk menambahkan user baru</p>
    </div>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="+6281234567890">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Status</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="active" class="text-green-600" checked>
                            <span class="ml-2">Aktif</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="inactive" class="text-red-600">
                            <span class="ml-2">Nonaktif</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Photo Upload -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center md:w-1/3">
                    <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                    <label for="photo" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload foto</p>
                        <p class="text-xs text-gray-500 mt-1">JPEG, PNG, SVG (Max: 2MB)</p>
                    </label>
                    <img id="photo-preview" class="mt-2 mx-auto max-h-40 hidden rounded-full">
                </div>
                <div class="md:w-2/3">
                    <div class="text-sm text-gray-600">
                        <p class="mb-2"><strong>Rekomendasi foto profil:</strong></p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Ukuran foto minimal 400x400 piksel</li>
                            <li>Format: JPG, PNG, atau SVG</li>
                            <li>Ukuran file maksimal 2MB</li>
                            <li>Foto dengan latar belakang netral</li>
                            <li>Wajah terlihat jelas</li>
                        </ul>
                    </div>
                </div>
            </div>
            @error('photo')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Verification -->
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="verify_email" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Verifikasi email sekarang</span>
            </label>
            <p class="text-xs text-gray-500 mt-1">Jika dicentang, user tidak perlu verifikasi email untuk login pertama kali.</p>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('users.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                Simpan User
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Photo preview
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
@endpush
