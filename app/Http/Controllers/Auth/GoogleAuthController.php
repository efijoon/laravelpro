<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    use Has2Fa;

    public function redirect()
    {
        return Socialite::driver("google")->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver("google")->stateless()->user();

            $user = User::updateOrCreate([
                "email" => $googleUser->email
            ], [
                "name" => $googleUser->name,
                "email" => $googleUser->email,
                "password" => bcrypt(Str::random(16))
            ]);

            return $this->check2Fa($request, $user) ?: redirect("/");
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
