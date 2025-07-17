<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Base Price</th>
                    <th>Cost Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($groups as $group)
                    <tr>
                        <td>{{ $group->group_code }}</td>
                        <td>{{ $group->group_name }}</td>
                        <td>{{ $group->group_type }}</td>
                        <td>{{ number_format($group->base_price, 2) }}</td>
                        <td>{{ number_format($group->cost_price, 2) }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" wire:click="editGroup({{ $group->id }})">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No groups found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
