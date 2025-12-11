@extends('layouts.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Edit User: {{ $user->name }}</h3>
                <p class="text-sm text-gray-600">Perbarui informasi user</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full">
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Kosongkan jika tidak ingin mengubah">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">Status</label>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="active" class="text-green-600" {{ $user->status === 'active' ? 'checked' : '' }}>
                            <span class="ml-2">Aktif</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="status" value="inactive" class="text-red-600" {{ $user->status === 'inactive' ? 'checked' : '' }}>
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
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="mb-2 mx-auto max-h-40 rounded-full">
                    @endif
                    <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                    <label for="photo" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600">Klik untuk upload foto baru</p>
                        <p class="text-xs text-gray-500 mt-1">JPEG, PNG, SVG (Max: 2MB)</p>
                    </label>
                    <img id="photo-preview" class="mt-2 mx-auto max-h-40 hidden rounded-full">
                </div>
                <div class="md:w-2/3">
                    <div class="text-sm text-gray-600">
                        @if($user->photo)
                            <p class="mb-2"><strong>Foto saat ini:</strong></p>
                            <p class="mb-4">Foto yang ada akan diganti dengan yang baru.</p>
                        @endif

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
            <div class="space-y-2">
                @if($user->email_verified_at)
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-3">
                            <i class="fas fa-check mr-1"></i> Email Terverifikasi
                        </span>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="unverify_email" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="ml-2 text-sm text-gray-700">Batalkan verifikasi email</span>
                        </label>
                    </div>
                @else
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mr-3">
                            <i class="fas fa-clock mr-1"></i> Email Belum Terverifikasi
                        </span>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="verify_email" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Verifikasi email sekarang</span>
                        </label>
                    </div>
                @endif
                <p class="text-xs text-gray-500">Status verifikasi email mempengaruhi kemampuan user untuk login.</p>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('users.index') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                Update User
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
