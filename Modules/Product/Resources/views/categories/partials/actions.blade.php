<a href="{{ route('product-categories.edit', $data->id) }}" class="btn btn-info btn-sm">
    <i class="bi bi-pencil"></i>
</a>
<button id="delete" class="btn btn-danger btn-sm" onclick="e.preventDefault();document.getElementById('destroy{{ $data->id }}').submit();">
    <i class="bi bi-trash"></i>
    <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('product-categories.destroy', $data->id) }}">
        @csrf
        @method('delete')
    </form>
</button>
