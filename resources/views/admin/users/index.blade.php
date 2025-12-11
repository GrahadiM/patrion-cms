@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Kelola User</h3>
            <p class="text-sm text-gray-600">Kelola semua user sistem Patrion CMS</p>
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
                        <a href="{{ route('users.export', ['format' => 'csv']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-file-csv mr-2"></i> CSV
                        </a>
                        <a href="{{ route('users.export', ['format' => 'json']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            <i class="fas fa-file-code mr-2"></i> JSON
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-600">Total User</p>
                    <p class="text-2xl font-bold text-blue-700">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-green-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-600">Aktif</p>
                    <p class="text-2xl font-bold text-green-700">{{ $stats['active'] }}</p>
                </div>
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-red-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-red-600">Nonaktif</p>
                    <p class="text-2xl font-bold text-red-700">{{ $stats['inactive'] }}</p>
                </div>
                <div class="p-2 bg-red-100 rounded-lg">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-purple-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-purple-600">Terverifikasi</p>
                    <p class="text-2xl font-bold text-purple-700">{{ $stats['verified'] }}</p>
                </div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-shield-check text-purple-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-600">Belum Verifikasi</p>
                    <p class="text-2xl font-bold text-yellow-700">{{ $stats['unverified'] }}</p>
                </div>
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-indigo-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-indigo-600">Hari Ini</p>
                    <p class="text-2xl font-bold text-indigo-700">{{ $stats['today'] }}</p>
                </div>
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <i class="fas fa-calendar-day text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="mb-6 bg-gray-50 rounded-lg p-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
            <div class="flex items-center space-x-4">
                <button id="bulkActive" class="inline-flex items-center px-4 py-2 border border-green-300 text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50">
                    <i class="fas fa-check-circle mr-2"></i> Aktifkan Terpilih
                </button>
                <button id="bulkInactive" class="inline-flex items-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
                    <i class="fas fa-times-circle mr-2"></i> Nonaktifkan Terpilih
                </button>
                <button id="bulkDelete" class="inline-flex items-center px-4 py-2 border border-red-600 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                    <i class="fas fa-trash mr-2"></i> Hapus Terpilih
                </button>
            </div>

            <div class="text-sm text-gray-600">
                <span id="selectedCount">0</span> user terpilih
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
        <table id="users-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifikasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aktivitas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data akan diisi oleh DataTables -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
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
            }
        ],
        columns: [
            {
                data: null,
                render: function(data, type, row) {
                    return '<input type="checkbox" class="select-row rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="' + row.id + '">';
                },
                orderable: false,
                searchable: false
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false
            },
            { data: 'photo_preview', name: 'photo', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status_badge', name: 'status', orderable: false },
            { data: 'email_verified', name: 'email_verified_at', orderable: false },
            { data: 'activity_count', name: 'activity_count', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        },
        order: [[3, 'asc']]
    });

    // Select all checkbox
    $('#select-all').on('click', function() {
        $('.select-row').prop('checked', this.checked);
        updateSelectedCount();
    });

    // Update selected count
    function updateSelectedCount() {
        const selected = $('.select-row:checked').length;
        $('#selectedCount').text(selected);
    }

    // Row checkbox change
    $(document).on('change', '.select-row', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
        updateSelectedCount();
    });

    // Bulk actions
    $('#bulkActive').on('click', function() {
        bulkAction('active');
    });

    $('#bulkInactive').on('click', function() {
        bulkAction('inactive');
    });

    $('#bulkDelete').on('click', function() {
        bulkDelete();
    });

    function bulkAction(status) {
        const selectedIds = getSelectedIds();

        if (selectedIds.length === 0) {
            Swal.fire('Peringatan!', 'Pilih minimal satu user.', 'warning');
            return;
        }

        const actionText = status === 'active' ? 'mengaktifkan' : 'menonaktifkan';

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `Anda akan ${actionText} ${selectedIds.length} user.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('users.bulk-status') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds,
                        status: status
                    },
                    success: function(response) {
                        Swal.fire('Berhasil!', response.message, 'success');
                        table.ajax.reload();
                        updateSelectedCount();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                    }
                });
            }
        });
    }

    function bulkDelete() {
        const selectedIds = getSelectedIds();

        if (selectedIds.length === 0) {
            Swal.fire('Peringatan!', 'Pilih minimal satu user.', 'warning');
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: `${selectedIds.length} user akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('users.bulk-destroy') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds
                    },
                    success: function(response) {
                        Swal.fire('Berhasil!', response.message, 'success');
                        table.ajax.reload();
                        updateSelectedCount();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON.message || 'Terjadi kesalahan.', 'error');
                    }
                });
            }
        });
    }

    function getSelectedIds() {
        const selectedIds = [];
        $('.select-row:checked').each(function() {
            selectedIds.push($(this).val());
        });
        return selectedIds;
    }
});
</script>
@endpush
