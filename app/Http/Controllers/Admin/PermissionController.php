<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:view-permissions'])->only(['index']);
        $this->middleware(['can:create-permission'])->only(['create', 'store']);
        $this->middleware(['can:edit-permission'])->only(['edit', 'update']);
        $this->middleware(['can:delete-permission'])->only(['destroy']);
    }

    public function index(Request $request)
    {
        $permissions = Permission::query();

        if ($keyword = $request->search) {
            $permissions
                ->where('name', 'LIKE', "%$keyword%")
                ->orWhere('label', 'LIKE', "%$keyword%")
                ->orWhere('id', $keyword);
        }

        $permissions = $permissions->paginate(20)->withQueryString();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|unique:permissions',
            'label' => 'required|min:3',
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        $permission = Permission::create($data);

        return redirect('/admin/permissions/create');
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'label' => 'required|min:3',
            'name' => ['required', 'min:3', Rule::unique('permissions')->ignore($permission->id)],
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        $permission->update($data);

        alert()->success('موفق', 'اجازه دسترسی با موفقیت ویرایش شد.');
        return redirect("/admin/permissions/$permission->id/edit");
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back();
    }
}
