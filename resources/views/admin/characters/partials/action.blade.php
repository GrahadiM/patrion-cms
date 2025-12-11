<div class="flex space-x-2">
    <a href="{{ route('characters.show', $character) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200" title="View">
        <i class="fas fa-eye text-sm"></i>
    </a>

    <a href="{{ route('characters.edit', $character) }}" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200" title="Edit">
        <i class="fas fa-edit text-sm"></i>
    </a>

    <form id="delete-form-{{ $character->id }}" action="{{ route('characters.destroy', $character) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <button onclick="confirmDelete('delete-form-{{ $character->id }}', '{{ $character->name }}')"
            class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200" title="Delete">
        <i class="fas fa-trash text-sm"></i>
    </button>
</div>
