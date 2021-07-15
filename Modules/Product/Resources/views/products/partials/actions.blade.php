<a href="{{ route('products.edit', $data->id) }}" class="btn btn-info btn-sm">
    <i class="bi bi-pencil"></i>
</a>
<a href="{{ route('products.show', $data->id) }}" class="btn btn-primary btn-sm">
    <i class="bi bi-eye"></i>
</a>
<button id="delete" class="btn btn-danger btn-sm" onclick="event.preventDefault();document.getElementById('destroy{{ $data->id }}').submit();">
    <i class="bi bi-trash"></i>
    <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('products.destroy', $data->id) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</button>
