@extends('layouts.app')

@section('title', 'Detail Activity Log')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail Activity Log</h3>
                <p class="text-sm text-gray-600">ID: {{ $activity->id }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('activity-logs.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <form id="delete-form-{{ $activity->id }}" action="{{ route('activity-logs.destroy', $activity) }}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
                <button onclick="confirmDelete('delete-form-{{ $activity->id }}')"
                        class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Basic Info -->
        <div class="lg:col-span-2">
            <div class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Informasi Dasar</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">ID</span>
                            <span class="text-gray-800">{{ $activity->id }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Log Name</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $activity->log_name }}
                            </span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Description</span>
                            <span class="text-gray-800">{{ $activity->description }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Waktu</span>
                            <span class="text-gray-800">{{ $activity->created_at->format('d F Y H:i:s') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Subject Type</span>
                            <span class="text-gray-800">{{ $activity->subject_type ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Subject ID</span>
                            <span class="text-gray-800">{{ $activity->subject_id ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Properties -->
                @if($activity->properties->count() > 0)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Properties</h4>
                        <div class="space-y-4">
                            @foreach($activity->properties as $key => $value)
                                <div>
                                    <span class="block text-sm font-medium text-gray-500 mb-1">{{ $key }}</span>
                                    @if(is_array($value) || is_object($value))
                                        <pre class="bg-gray-100 p-3 rounded text-sm overflow-x-auto">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        <div class="bg-gray-100 p-3 rounded text-sm">{{ $value }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Extra Properties -->
                @php
                    $extraProperties = [
                        'ip' => 'IP Address',
                        'user_agent' => 'User Agent',
                        'route' => 'Route',
                        'method' => 'HTTP Method',
                        'path' => 'Path'
                    ];

                    $hasExtraProperties = false;
                    foreach ($extraProperties as $key => $label) {
                        if ($activity->getExtraProperty($key)) {
                            $hasExtraProperties = true;
                            break;
                        }
                    }
                @endphp

                @if($hasExtraProperties)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Extra Properties</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($extraProperties as $key => $label)
                                @if($activity->getExtraProperty($key))
                                    <div>
                                        <span class="block text-sm font-medium text-gray-500">{{ $label }}</span>
                                        <span class="text-gray-800">
                                            @if($key === 'user_agent')
                                                <span class="text-sm font-mono">{{ $activity->getExtraProperty($key) }}</span>
                                            @else
                                                {{ $activity->getExtraProperty($key) }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: User & Subject Info -->
        <div class="lg:col-span-1">
            <!-- User Information -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">User Information</h4>
                @if($activity->causer)
                    <div class="flex items-center space-x-3">
                        @if($activity->causer->photo)
                            <img src="{{ asset('storage/' . $activity->causer->photo) }}" alt="{{ $activity->causer->name }}" class="w-12 h-12 rounded-full">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <div class="font-medium text-gray-800">{{ $activity->causer->name }}</div>
                            <div class="text-sm text-gray-600">{{ $activity->causer->email }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                <span class="px-2 py-1 rounded-full {{ $activity->causer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $activity->causer->status === 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 space-y-2">
                        <div>
                            <span class="text-sm text-gray-500">Phone:</span>
                            <span class="text-sm text-gray-800 ml-2">{{ $activity->causer->phone ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">Registered:</span>
                            <span class="text-sm text-gray-800 ml-2">{{ $activity->causer->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-robot text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">System Generated</p>
                    </div>
                @endif
            </div>

            <!-- Subject Information -->
            @if($subject)
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Subject Information</h4>

                    @if($subject instanceof \App\Models\Character)
                        <div class="flex items-center space-x-3">
                            @if($subject->image)
                                <img src="{{ asset('storage/' . $subject->image) }}" alt="{{ $subject->name }}" class="w-12 h-12 rounded">
                            @else
                                <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-800">{{ $subject->name }}</div>
                                <div class="text-sm text-gray-600">{{ $subject->region }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span class="px-2 py-1 rounded-full {{ $subject->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $subject->status === 'published' ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('characters.show', $subject) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Karakter
                            </a>
                        </div>

                    @elseif($subject instanceof \App\Models\Program)
                        <div class="flex items-center space-x-3">
                            @if($subject->thumbnail)
                                <img src="{{ asset('storage/' . $subject->thumbnail) }}" alt="{{ $subject->title }}" class="w-12 h-12 rounded">
                            @else
                                <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-film text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-800">{{ \Str::limit($subject->title, 30) }}</div>
                                <div class="text-sm text-gray-600">{{ ucfirst($subject->platform) }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    @php
                                        $statusColors = [
                                            'draft' => 'yellow',
                                            'upcoming' => 'blue',
                                            'ongoing' => 'green',
                                            'completed' => 'gray'
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 rounded-full bg-{{ $statusColors[$subject->status] ?? 'gray' }}-100 text-{{ $statusColors[$subject->status] ?? 'gray' }}-800">
                                        {{ ucfirst($subject->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('programs.show', $subject) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Program
                            </a>
                        </div>

                    @elseif($subject instanceof \App\Models\User)
                        <div class="flex items-center space-x-3">
                            @if($subject->photo)
                                <img src="{{ asset('storage/' . $subject->photo) }}" alt="{{ $subject->name }}" class="w-12 h-12 rounded-full">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-800">{{ $subject->name }}</div>
                                <div class="text-sm text-gray-600">{{ $subject->email }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span class="px-2 py-1 rounded-full {{ $subject->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $subject->status === 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button onclick="showUserProfile({{ $subject->id }})" class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat User
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Related Activities -->
            @if($activity->subject_type && $activity->subject_id)
                <div class="bg-gray-50 rounded-lg p-6 mt-6">
                    <h4 class="text-md font-semibold text-gray-800 mb-4">Aktivitas Terkait</h4>
                    @php
                        $relatedActivities = \Spatie\Activitylog\Models\Activity::where('subject_type', $activity->subject_type)
                            ->where('subject_id', $activity->subject_id)
                            ->where('id', '!=', $activity->id)
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp

                    @if($relatedActivities->count() > 0)
                        <div class="space-y-3">
                            @foreach($relatedActivities as $related)
                                <div class="border-l-4 border-blue-500 pl-3 py-1">
                                    <div class="text-sm text-gray-800">{{ $related->description }}</div>
                                    <div class="text-xs text-gray-500">{{ $related->created_at->format('d M H:i') }}</div>
                                    <div class="text-xs">
                                        <a href="{{ route('activity-logs.show', $related) }}" class="text-blue-600 hover:text-blue-800">
                                            Lihat detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('activity-logs.index', ['subject_type' => $activity->subject_type, 'subject_id' => $activity->subject_id]) }}"
                               class="text-sm text-blue-600 hover:text-blue-800">
                                Lihat semua aktivitas terkait
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Tidak ada aktivitas terkait lainnya.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(formId) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Log activity ini akan dihapus permanen!",
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

function showUserProfile(userId) {
    // You can implement a modal or redirect to user profile
    window.location.href = "{{ url('admin/users') }}/" + userId;
}
</script>
@endpush
