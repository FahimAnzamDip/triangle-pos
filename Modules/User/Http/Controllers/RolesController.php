<?php

namespace Modules\User\Http\Controllers;

use App\DataTables\RolesDataTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(RolesDataTable $dataTable) {
        return $dataTable->render('user::roles.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('user::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->givePermissionTo($request->permissions);

        toast('Role Created With Selected Permissions!', 'success');

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role) {
        return view('user::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Role $role) {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        toast('Role Updated With Selected Permissions!', 'success');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role) {
        $role->delete();

        toast('Role Deleted!', 'success');

        return redirect()->route('roles.index');
    }
}
