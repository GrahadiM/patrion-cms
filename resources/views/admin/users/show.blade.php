@extends('layouts.app')

@section('title', 'Detail User: ' . $user->name)

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail User: {{ $user->name }}</h3>
                <p class="text-sm text-gray-600">Informasi lengkap user</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-medium rounded-md hover:bg-yellow-600">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Profile Info -->
        <div class="lg:col-span-1">
            <!-- Profile Card -->
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="text-center mb-6">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-white shadow">
                    @else
                        <div class="w-32 h-32 rounded-full mx-auto mb-4 bg-gray-200 flex items-center justify-center border-4 border-white shadow">
                            <i class="fas fa-user text-gray-400 text-4xl"></i>
                        </div>
                    @endif

                    <h4 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h4>
                    <p class="text-gray-600">{{ $user->email }}</p>

                    <div class="mt-4 flex justify-center space-x-2">
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <i class="fas {{ $user->status === 'active' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                            {{ $user->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>

                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            <i class="fas {{ $user->email_verified_at ? 'fa-shield-check' : 'fa-clock' }} mr-1"></i>
                            {{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}
                        </span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Nomor Telepon</span>
                        <span class="text-gray-800">{{ $user->phone ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Bergabung Pada</span>
                        <span class="text-gray-800">{{ $user->created_at->format('d F Y H:i') }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Terakhir Update</span>
                        <span class="text-gray-800">{{ $user->updated_at->format('d F Y H:i') }}</span>
                    </div>

                    @if($user->email_verified_at)
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Email Terverifikasi</span>
                            <span class="text-gray-800">{{ $user->email_verified_at->format('d F Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-gray-50 rounded-lg p-6 mt-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Statistik</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Aktivitas</span>
                        <span class="font-semibold text-gray-800">{{ $stats['total_activities'] }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Karakter Dibuat</span>
                        <span class="font-semibold text-gray-800">{{ $stats['characters_created'] }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Program Dibuat</span>
                        <span class="font-semibold text-gray-800">{{ $stats['programs_created'] }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Jumlah Login</span>
                        <span class="font-semibold text-gray-800">{{ $stats['login_count'] }}</span>
                    </div>

                    @if($stats['last_login'])
                        <div class="pt-4 border-t border-gray-200">
                            <span class="block text-sm font-medium text-gray-500">Login Terakhir</span>
                            <span class="text-sm text-gray-800">{{ $stats['last_login']->format('d F Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Activities -->
        <div class="lg:col-span-2">
            <!-- User Information -->
            <div class="bg-gray-50 rounded-lg p-6 mt-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Informasi Sistem</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">User ID</span>
                        <span class="text-gray-800 font-mono">{{ $user->id }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Email Provider</span>
                        <span class="text-gray-800">{{ explode('@', $user->email)[1] ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Password Terakhir Diubah</span>
                        <span class="text-gray-800">
                            @php
                                $passwordChanged = \Spatie\Activitylog\Models\Activity::where(function($query) use ($user) {
                                        $query->where('causer_id', $user->id)
                                            ->orWhere('subject_id', $user->id);
                                    })
                                    ->where('description', 'like', '%password%')
                                    ->latest()
                                    ->first();
                            @endphp
                            {{ $passwordChanged ? $passwordChanged->created_at->format('d F Y H:i') : 'Tidak ada riwayat' }}
                        </span>
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-gray-500">Timezone</span>
                        <span class="text-gray-800">{{ config('app.timezone') }}</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h4>

                @if($recentActivities->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <div class="bg-white rounded-lg border border-gray-200 p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center space-x-2 mb-2">
                                            @php
                                                $icon = match($activity->log_name) {
                                                    'characters' => 'fa-user',
                                                    'programs' => 'fa-film',
                                                    'users' => 'fa-users',
                                                    default => 'fa-history'
                                                };

                                                $color = match($activity->log_name) {
                                                    'characters' => 'blue',
                                                    'programs' => 'purple',
                                                    'users' => 'green',
                                                    default => 'gray'
                                                };
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
                                                <i class="fas {{ $icon }} mr-1"></i>
                                                {{ ucfirst($activity->log_name) }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $activity->created_at->format('d M H:i') }}</span>
                                        </div>

                                        <p class="text-sm text-gray-800">{{ $activity->description }}</p>

                                        @if($activity->subject_type && $activity->subject_id)
                                            <div class="mt-2">
                                                <span class="text-xs text-gray-600">
                                                    Subject: {{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('activity-logs.show', $activity) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('activity-logs.index', ['user_id' => $user->id]) }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-history mr-2"></i> Lihat Semua Aktivitas
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-history text-3xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600">Belum ada aktivitas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
