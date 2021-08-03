<div class="btn-group dropleft">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('edit_sales')
            <a href="{{ route('sales.edit', $data->id) }}" class="dropdown-item">
                <i class="bi bi-pencil mr-2" style="line-height: 1;"></i> Edit
            </a>
        @endcan
        @can('show_sales')
            <a href="{{ route('sales.show', $data->id) }}" class="dropdown-item">
                <i class="bi bi-eye mr-2" style="line-height: 1;"></i> Details
            </a>
        @endcan
        @can('delete_sales')
            <button id="delete" class="dropdown-item" onclick="
                event.preventDefault();
                if (confirm('Are you sure? It will delete the dNPata permanently!')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
                <i class="bi bi-trash mr-2" style="line-height: 1;"></i> Delete
                <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('sales.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </button>
        @endcan
    </div>
</div>
