<div class="btn-group dropleft">
    <button type="button" class="btn btn-ghost-primary dropdown rounded" data-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots-vertical"></i>
    </button>
    <div class="dropdown-menu">
        @can('create_quotation_sales')
            <a href="{{ route('quotation-sales.create', $data) }}" class="dropdown-item">
                <i class="bi bi-check2-circle mr-2 text-success" style="line-height: 1;"></i> {{ __('quotation::messages.make_sale') }}
            </a>
        @endcan
        @can('send_quotation_mails')
            <a href="{{ route('quotation.email', $data) }}" class="dropdown-item">
                <i class="bi bi-cursor mr-2 text-warning" style="line-height: 1;"></i> {{ __('quotation::messages.send_email') }}
            </a>
        @endcan
        @can('edit_quotations')
            <a href="{{ route('quotations.edit', $data->id) }}" class="dropdown-item">
                <i class="bi bi-pencil mr-2 text-primary" style="line-height: 1;"></i> {{ __('quotation::messages.edit') }}
            </a>
        @endcan
        @can('show_quotations')
            <a href="{{ route('quotations.show', $data->id) }}" class="dropdown-item">
                <i class="bi bi-eye mr-2 text-info" style="line-height: 1;"></i> {{ __('quotation::messages.details') }}
            </a>
        @endcan
        @can('delete_quotations')
            <button id="delete" class="dropdown-item" onclick="
                event.preventDefault();
                if (confirm('{{ __('quotation::messages.confirm_delete') }}')) {
                document.getElementById('destroy{{ $data->id }}').submit()
                }">
                <i class="bi bi-trash mr-2 text-danger" style="line-height: 1;"></i> {{ __('quotation::messages.delete') }}
                <form id="destroy{{ $data->id }}" class="d-none" action="{{ route('quotations.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
            </button>
        @endcan
    </div>
</div>
