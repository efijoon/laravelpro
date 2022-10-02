<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActiveCode;
use App\Models\User;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function show2Fa(Request $request) {
        if(! $request->session()->get("auth"))
            return redirect(route('login'));

        $request->session()->reflash();

        return view('auth.2fa');
    }

    public function verify2Fa(Request $request)
    {
        if(! $request->session()->get("auth"))
            return redirect(route('login'));

        $data = $request->validate([
            "code" => "required"
        ]);

        $user = User::findOrFail($request->session()->get('auth.user_id'));

        // check entered code
        $status = ActiveCode::verifyCode($user, $data['code']);
        if(! $status) {
            $request->session()->reflash();
            return back()->withErrors(["Your code was invalid."]);
        }

        if(auth()->loginUsingId($user->id, $request->session()->get('auth.remember'))) {
            $user->activeCode()->delete();
            return redirect('/');
        }

        return redirect(route('login'));
    }
}
