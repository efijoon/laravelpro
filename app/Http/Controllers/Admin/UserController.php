<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if ($keyword = $request->search) {
            $users
                ->where(function ($query) use ($keyword) {
                    $query
                        ->where('email', 'LIKE', "%$keyword%")
                        ->orWhere('name', 'LIKE', "%$keyword%")
                        ->orWhere('id', $keyword);
                })
                ->where(function ($query) use ($request) {
                   if($request->onlyAdmins) {
                       $query->where('is_superuser', 1)->orWhere('is_staff', 1);
                   } else {
                       $query->where('is_superuser', null)->orWhere('is_staff', null);
                   }
                });
        }

        $users = $users->latest()->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        $user = User::create($data);

        alert()->success('موفق', 'کاربر با موفقیت ایجاد شد.');
        return redirect('/admin/users/create');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ], [
            'name.required' => 'فیلد نام یک فیلد الزامی میباشد.'
        ]);

        if (!is_null($request->password)) {
            $data = $request->validate([
                'password' => 'required|min:8',
            ]);

            $data['password'] = $request->password;
        }

        $user->update($data);

        alert()->success('موفق', 'کاربر با موفقیت ویرایش شد.');
        return redirect("/admin/users/$user->id/edit");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function permissions(User $user)
    {
        return view('admin.users.permissions', compact('user'));
    }

    public function updatePermissions(Request $request, User $user)
    {
        $data = $request->validate([
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $user->permissions()->sync(isset($data['permissions']) ? $data['permissions'] : []);
        $user->roles()->sync(isset($data['roles']) ? $data['roles'] : []);

        alert()->success('موفق', 'سطوح و اجازه های دسترسی کاربر با موفقیت بروزرسانی شد.');
        return back();
    }
}
