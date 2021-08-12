@foreach($data->getPermissionNames() as $permission)
    <span class="badge badge-primary">{{ $permission }}</span>
@endforeach
<a class="text-primary" href="{{ route('roles.edit', $data->id) }}">.......</a>
