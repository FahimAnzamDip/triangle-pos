<div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('access_sale_payments')
            <a href="{{ route('sale-return-payments.index', $data->id) }}" class="dropdown-item">
                <i class="bi bi-cash-coin mr-2 text-warning" style="line-height: 1;"></i> {{ __('salesreturn::messages.show_payments') }}
            </a>
        @endcan
        @can('access_sale_payments')
            @if($data->due_amount > 0)
                <a href="{{ route('sale-return-payments.create', $data->id) }}" class="dropdown-item">
                    <i class="bi bi-plus-circle-dotted mr-2 text-success" style="line-height: 1;"></i> {{ __('salesreturn::messages.add_payment') }}
                </a>
            @endif
        @endcan
        @can('edit_sales')
            <a href="{{ route('sale-returns.edit', $data->id) }}" class="dropdown-item">
                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> {{ __('salesreturn::messages.edit') }}
            </a>
        @endcan
        @can('show_sales')
            <a href="{{ route('sale-returns.show', $data->id) }}" class="dropdown-item">
                <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> {{ __('salesreturn::messages.details') }}
            </a>
        @endcan
        @can('delete_sales')
            <button id="delete" class="dropdown-item" onclick="
                event.preventDefault();
                if (confirm('{{ __('salesreturn::messages.confirm_delete') }}')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
                <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> {{ __('salesreturn::messages.delete') }}
                <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('sale-returns.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </button>
        @endcan
    </div>
</div>
