@if ($data->payment_status == 'Partial')
    <span class="badge badge-warning">
        {{ $data->payment_status }}
    </span>
@elseif ($data->payment_status == 'Paid')
    <span class="badge badge-success">
        {{ $data->payment_status }}
    </span>
@else
    <span class="badge badge-danger">
        {{ $data->payment_status }}
    </span>
@endif
