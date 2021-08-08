@can('access_sale_payments')
    <a href="{{ route('purchase-payments.edit', [$data->purchase->id, $data->id]) }}" class="btn btn-info btn-sm">
        <i class="bi bi-pencil"></i>
    </a>
@endcan
@can('access_sale_payments')
    <button id="delete" class="btn btn-danger btn-sm" onclick="
        event.preventDefault();
        if (confirm('Are you sure? It will delete the data permanently!')) {
        document.getElementById('destroy{{ $data->id }}').submit()
        }
        ">
        <i class="bi bi-trash"></i>
        <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('purchase-payments.destroy', $data->id) }}" method="POST">
            @csrf
            @method('delete')
        </form>
    </button>
@endcan
