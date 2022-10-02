<?php

namespace App\Http\Controllers\Auth;

use App\Models\ActiveCode;
use App\Notifications\LoginToWebsite;
use Illuminate\Http\Request;

trait Has2Fa
{
    public function check2Fa(Request $request, $user)
    {
        if ($user->has2Fa($user)) {
            auth()->logout();

            $request->session()->flash('auth', [
                'user_id' => $user->id,
                'remember' => $request->remember
            ]);

            if ($user->two_factor_type === 'sms') {
                $code = ActiveCode::generateCode($user);

                // TODO send sms
                // ...

                $request->session()->push('auth.using_sms', true);

                return redirect('/auth/2fa');
            }
        }

        $request->user()->notify(new LoginToWebsite());

        return false;

    }
}
