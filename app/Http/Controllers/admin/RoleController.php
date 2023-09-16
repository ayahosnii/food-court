<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Admin;
use App\Models\providers\Provider;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }
    public function assignRoleForm()
    {
        $roles = Role::all();
        $users = Provider::all();

        return view('admin.roles.assign-role', compact('roles', 'users'));
    }

    public function assignRole(Request $request)
    {
        // Validate the form data
        $request->validate([
            'user' => 'required|exists:users,id',
            'role' => 'required|exists:roles,id',
        ]);

        // Retrieve the user and role
        $user = Provider::findOrFail($request->user);
        $role = Role::findOrFail($request->role);

        // Assign the role to the user
        $user->assignRole($role);

        return redirect()->route('admin.assign-role-form')->with('success', 'Role assigned successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'nullable|array', // Make sure 'permissions' is an array
        ]);

        // Create a new role
        $role = new Role();
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $role->save();

        // Attach selected permissions to the role (assuming a many-to-many relationship)
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions); // Replace with the appropriate method

        // Redirect to the role index page with a success message
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the role by ID and load associated permissions
        $role = Role::with('permissions')->findOrFail($id);

        // Retrieve a list of all available permissions (you may load this differently)
        $permissions = Permission::all(); // Replace with your Permission model

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'permissions' => 'nullable|array', // Make sure 'permissions' is an array
        ]);

        // Retrieve the role by ID
        $role = Role::findOrFail($id);

        // Update the role's attributes
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');

        // Sync the role's permissions (assuming a many-to-many relationship)
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions); // Replace with the appropriate method

        // Save the role
        $role->save();

        // Redirect back to the edit page with a success message
        return redirect()->route('admin.roles.edit', $role->id)->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
