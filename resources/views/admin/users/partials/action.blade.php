<div class="flex space-x-2">
    <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200" title="View Detail">
        <i class="fas fa-eye text-sm"></i>
    </a>

    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200" title="Edit">
        <i class="fas fa-edit text-sm"></i>
    </a>

    @if($user->id !== auth()->id())
        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>

        <button onclick="confirmDelete('delete-form-{{ $user->id }}', '{{ $user->name }}')"
                class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200" title="Delete">
            <i class="fas fa-trash text-sm"></i>
        </button>
    @else
        <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-400 rounded-md cursor-not-allowed" title="Cannot delete yourself">
            <i class="fas fa-trash text-sm"></i>
        </span>
    @endif
</div>

<script>
function confirmDelete(formId, name) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `User "${name}" akan dihapus permanen!`,
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
