@extends('layouts.app')

@section('title', 'Kelola Program')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Program</h3>
            <p class="text-sm text-gray-600">Kelola program Patrion Universe</p>
        </div>
        <a href="{{ route('programs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i> Tambah Program
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200">
        <table id="programs-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Karakter</th>
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
    const table = $('#programs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('programs.index') }}",
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
                        Swal.fire('Peringatan!', 'Pilih minimal satu program untuk dihapus.', 'warning');
                        return;
                    }

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `${selectedIds.length} program akan dihapus permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('programs.bulk-destroy') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    ids: selectedIds
                                },
                                success: function(response) {
                                    Swal.fire('Berhasil!', response.success, 'success');
                                    table.ajax.reload();
                                },
                                error: function(xhr) {
                                    Swal.fire('Error!', xhr.responseJSON.error || 'Terjadi kesalahan.', 'error');
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
            { data: 'thumbnail_preview', name: 'thumbnail', orderable: false, searchable: false },
            { data: 'title', name: 'title' },
            { data: 'platform_badge', name: 'platform', orderable: false },
            { data: 'status_badge', name: 'status', orderable: false },
            { data: 'characters_list', name: 'characters', orderable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        },
        order: [[2, 'asc']]
    });
});
</script>
@endpush
