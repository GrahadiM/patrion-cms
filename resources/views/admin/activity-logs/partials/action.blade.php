<div class="flex space-x-2">
    <a href="{{ route('activity-logs.show', $activity) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200" title="View Detail">
        <i class="fas fa-eye text-sm"></i>
    </a>

    <form id="delete-form-{{ $activity->id }}" action="{{ route('activity-logs.destroy', $activity) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <button onclick="confirmDelete('delete-form-{{ $activity->id }}')"
            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200" title="Delete">
        <i class="fas fa-trash text-sm"></i>
    </button>
</div>

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
</script>
