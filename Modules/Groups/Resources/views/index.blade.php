@extends('groups::layouts.master')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Jewelry Master Groups</h2>
            <button class="btn btn-primary" onclick="Livewire.emit('showGroupForm')">Add Group</button>
        </div>
        <livewire:groups.group-table />
        <livewire:groups.group-form />
    </div>
@endsection
