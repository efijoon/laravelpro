<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:view-roles'])->only(['index']);
        $this->middleware(['can:create-role'])->only(['create', 'store']);
        $this->middleware(['can:edit-role'])->only(['edit', 'update']);
        $this->middleware(['can:delete-role'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        $roles = Role::query();

        if ($keyword = $request->search) {
            $roles
                ->where('name', 'LIKE', "%$keyword%")
                ->orWhere('label', 'LIKE', "%$keyword%")
                ->orWhere('id', $keyword);
        }

        $roles = $roles->paginate(20)->withQueryString();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|unique:roles',
            'label' => 'required|min:3',
            'permissions' => 'required|array'
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        $role = Role::create($data);
        $role->permissions()->sync($data['permissions']);

        alert()->success('موفق', 'سطح دسترسی با موفقیت ایجاد شد.');
        return redirect('/admin/roles/create');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'label' => 'required|min:3',
            'name' => ['required', 'min:3', Rule::unique('roles')->ignore($role->id)],
            'permissions' => 'required|array'
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permissions']);

        alert()->success('موفق', 'سطح دسترسی با موفقیت ویرایش شد.');
        return redirect("/admin/roles/$role->id/edit");
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return back();
    }
}
