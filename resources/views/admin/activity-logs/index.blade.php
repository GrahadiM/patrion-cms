@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Activity Log</h3>
            <p class="text-sm text-gray-600">Monitor semua aktivitas di sistem</p>
        </div>
        <div class="flex space-x-3">
            <!-- Export Button -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-download mr-2"></i> Export
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>

                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1" role="menu">
                        <a href="{{ route('activity-logs.export', ['format' => 'csv']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-file-csv mr-2"></i> CSV
                        </a>
                        <a href="{{ route('activity-logs.export', ['format' => 'json']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-file-code mr-2"></i> JSON
                        </a>
                    </div>
                </div>
            </div>

            <!-- Clear Old Logs -->
            <button onclick="clearOldLogs()" class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                <i class="fas fa-trash mr-2"></i> Hapus Log Lama
            </button>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600">Total Log</p>
                    <p class="text-2xl font-bold text-blue-700">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-history text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600">Hari Ini</p>
                    <p class="text-2xl font-bold text-green-700">{{ $stats['today'] }}</p>
                </div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-calendar-day text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600">Users Aktif</p>
                    <p class="text-2xl font-bold text-purple-700">{{ $stats['users'] }}</p>
                </div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-users text-purple-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-600">Karakter</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $stats['characters'] }}</p>
                </div>
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-user text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-red-600">Program</p>
                    <p class="text-2xl font-bold text-red-700">{{ $stats['programs'] }}</p>
                </div>
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-film text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-indigo-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-indigo-600">Users</p>
                    <p class="text-2xl font-bold text-indigo-700">{{ $stats['users_activity'] }}</p>
                </div>
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <i class="fas fa-user-cog text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 bg-gray-50 rounded-lg p-4">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-4 md:space-y-0">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Log Type</label>
                <select id="logTypeFilter" class="w-full md:w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua</option>
                    <option value="characters">Karakter</option>
                    <option value="programs">Program</option>
                    <option value="users">Users</option>
                    <option value="default">System</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select id="userFilter" class="w-full md:w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua User</option>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <div class="flex space-x-2">
                    <input type="date" id="dateFrom" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <input type="date" id="dateTo" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex items-end">
                <button id="applyFilters" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Terapkan Filter
                </button>
                <button id="resetFilters" class="ml-2 px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50">
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Activity Log Table -->
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
        <table id="activity-logs-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aktivitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Properties</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data akan diisi oleh DataTables -->
            </tbody>
        </table>
    </div>
</div>

<!-- Properties Modal -->
<div id="propertiesModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Properties Detail</h3>
            <button onclick="closePropertiesModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="propertiesContent" class="max-h-96 overflow-y-auto">
            <!-- Properties will be loaded here -->
        </div>
    </div>
</div>

<!-- Clear Logs Modal -->
<div id="clearLogsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Hapus Log Lama</h3>
            <button onclick="closeClearLogsModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mb-6">
            <p class="text-gray-600 mb-4">Pilih berapa hari log yang akan dihapus:</p>
            <div class="grid grid-cols-3 gap-3">
                <button onclick="setDays(7)" class="px-4 py-2 border border-gray-300 rounded-md text-sm hover:bg-gray-50">7 hari</button>
                <button onclick="setDays(30)" class="px-4 py-2 border border-gray-300 rounded-md text-sm hover:bg-gray-50">30 hari</button>
                <button onclick="setDays(90)" class="px-4 py-2 border border-gray-300 rounded-md text-sm hover:bg-gray-50">90 hari</button>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Custom (hari)</label>
                <input type="number" id="customDays" min="1" value="30" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Peringatan:</strong> Aksi ini tidak dapat dibatalkan. Log yang dihapus tidak dapat dipulihkan.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <button onclick="closeClearLogsModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Batal
            </button>
            <button onclick="confirmClearLogs()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Hapus Log
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const table = $('#activity-logs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('activity-logs.index') }}",
            data: function(d) {
                d.log_type = $('#logTypeFilter').val();
                d.user_id = $('#userFilter').val();
                d.date_from = $('#dateFrom').val();
                d.date_to = $('#dateTo').val();
            }
        },
        responsive: true,
        dom: '<"flex flex-col lg:flex-row justify-between items-center mb-4"<"mb-4 lg:mb-0"l><"mb-4 lg:mb-0"f><"flex space-x-2"B>>rt<"flex flex-col lg:flex-row justify-between items-center"ip>',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy mr-2"></i> Copy',
                className: 'inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50'
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                className: 'inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                className: 'inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print mr-2"></i> Print',
                className: 'inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50'
            },
            {
                text: '<i class="fas fa-trash mr-2"></i> Hapus Terpilih',
                className: 'inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 bulk-delete-btn',
                action: function (e, dt, node, config) {
                    const selectedIds = [];
                    $('.select-row:checked').each(function() {
                        selectedIds.push($(this).val());
                    });

                    if (selectedIds.length === 0) {
                        Swal.fire('Peringatan!', 'Pilih minimal satu log untuk dihapus.', 'warning');
                        return;
                    }

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `${selectedIds.length} log akan dihapus permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('activity-logs.bulk-destroy') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: selectedIds
                                },
                                success: function(response) {
                                    Swal.fire('Berhasil!', response.message, 'success');
                                    table.ajax.reload();
                                },
                                error: function(xhr) {
                                    Swal.fire('Error!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                                }
                            });
                        }
                    });
                }
            }
        ],
        columns: [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false
            },
            { data: 'time', name: 'created_at' },
            { data: 'user', name: 'causer.name', orderable: false },
            { data: 'description', name: 'description', orderable: false },
            { data: 'properties', name: 'properties', orderable: false, searchable: false },
            { data: 'ip', name: 'ip', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        },
        order: [[1, 'desc']]
    });

    // Apply filters
    $('#applyFilters').on('click', function() {
        table.ajax.reload();
    });

    // Reset filters
    $('#resetFilters').on('click', function() {
        $('#logTypeFilter').val('');
        $('#userFilter').val('');
        $('#dateFrom').val('');
        $('#dateTo').val('');
        table.ajax.reload();
    });
});

// Show properties modal
function showProperties(id) {
    $.ajax({
        url: "{{ url('admin/activity-logs') }}/" + id,
        type: 'GET',
        success: function(response) {
            const activity = response.activity;
            let html = '<div class="space-y-4">';

            // Basic info
            html += '<div><h4 class="font-semibold text-gray-700 mb-2">Informasi Log:</h4>';
            html += '<div class="bg-gray-50 p-4 rounded">';
            html += '<p><strong>ID:</strong> ' + activity.id + '</p>';
            html += '<p><strong>Log Name:</strong> ' + activity.log_name + '</p>';
            html += '<p><strong>Description:</strong> ' + activity.description + '</p>';
            html += '<p><strong>Subject Type:</strong> ' + activity.subject_type + '</p>';
            html += '<p><strong>Subject ID:</strong> ' + activity.subject_id + '</p>';
            html += '<p><strong>Created At:</strong> ' + activity.created_at + '</p>';
            html += '</div></div>';

            // Properties
            if (activity.properties && Object.keys(activity.properties).length > 0) {
                html += '<div><h4 class="font-semibold text-gray-700 mb-2">Properties:</h4>';
                html += '<pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">' +
                        JSON.stringify(activity.properties, null, 2) + '</pre></div>';
            }

            // Extra properties
            const extraProps = [];
            if (activity.ip) extraProps.push({ key: 'IP Address', value: activity.ip });
            if (activity.user_agent) extraProps.push({ key: 'User Agent', value: activity.user_agent });
            if (activity.route) extraProps.push({ key: 'Route', value: activity.route });
            if (activity.method) extraProps.push({ key: 'Method', value: activity.method });
            if (activity.path) extraProps.push({ key: 'Path', value: activity.path });

            if (extraProps.length > 0) {
                html += '<div><h4 class="font-semibold text-gray-700 mb-2">Extra Properties:</h4>';
                html += '<div class="bg-gray-50 p-4 rounded">';
                extraProps.forEach(prop => {
                    html += '<p><strong>' + prop.key + ':</strong> ' + prop.value + '</p>';
                });
                html += '</div></div>';
            }

            html += '</div>';

            document.getElementById('propertiesContent').innerHTML = html;
            document.getElementById('propertiesModal').classList.remove('hidden');
        }
    });
}

function closePropertiesModal() {
    document.getElementById('propertiesModal').classList.add('hidden');
}

function clearOldLogs() {
    document.getElementById('clearLogsModal').classList.remove('hidden');
}

function closeClearLogsModal() {
    document.getElementById('clearLogsModal').classList.add('hidden');
}

function setDays(days) {
    document.getElementById('customDays').value = days;
}

function confirmClearLogs() {
    const days = document.getElementById('customDays').value;

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Log yang lebih tua dari ${days} hari akan dihapus permanen!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('activity-logs.clear-all') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    days: days
                },
                success: function(response) {
                    Swal.fire('Berhasil!', response.message, 'success');
                    closeClearLogsModal();
                    $('#activity-logs-table').DataTable().ajax.reload();
                    location.reload(); // Reload untuk update stats
                },
                error: function(xhr) {
                    Swal.fire('Error!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                }
            });
        }
    });
}
</script>
@endpush
