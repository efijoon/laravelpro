<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:update,user')->only(['edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
