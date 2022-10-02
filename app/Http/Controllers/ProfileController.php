<?php

namespace App\Http\Controllers;

use App\Models\ActiveCode;
use App\Models\User;
use App\Notifications\ActiveCodeNotif;
use App\Notifications\LoginToWebsite;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->notify(new LoginToWebsite());
        return view("profile.index");
    }

    public function twoFactor()
    {
        return view("profile.twoFactor");
    }

    public function changeTwoFactor(Request $request)
    {
        $data = $request->validate([
            "type" => "required|in:disable,sms",
            "phone_number" => [
                "required_unless:type,disable".
                Rule::unique('users', 'phone_number')->ignore($request->user()->id)
            ],
        ]);

        if($data["type"] === "sms") {
            if($data["phone_number"] !== auth()->user()->phone_number) {
                // make new code and send it to user
                $code = ActiveCode::generateCode(auth()->user());

                // send Sms
                $request->user()->notify(new ActiveCodeNotif($data["phone_number"], $code));

                // save user phone_number in session
                $request->session()->flash("phone_number", $data["phone_number"]);

                return redirect("/profile/verify-phone-number");
            } else {
                auth()->user()->update([
                    "two_factor_type" => "sms"
                ]);
            }
        } else if($data["type"] === "disable") {
            auth()->user()->update([
                "two_factor_type" => "disable"
            ]);
        }

        alert()->success("Success", "Two Factor Settings has been successfully changed.");
        return back();
    }

    public function showVerifyPhonePage(Request $request)
    {
        if(! $request->session()->get("phone_number"))
            return redirect("/profile/twoFactor");

        $request->session()->reflash();

        return view("profile.verify_phone_number");
    }

    public function verifyPhoneNumber(Request $request)
    {
        $data = $request->validate([
            "code" => "required"
        ]);

        if(! $request->session()->has("phone_number"))
            return redirect("/profile/twoFactor");

        $status = ActiveCode::verifyCode($request->user(), $data["code"]);
        if(! $status) {
            $request->session()->reflash();
            return back()->withErrors(["Your code was invalid."]);
        }

        // update user info
        $request->user()->update([
            "two_factor_type" => "sms",
            "phone_number" => $request->session()->get("phone_number")
        ]);

        // remove all user active codes
        $request->user()->activeCode()->delete();

        alert()->success("Success", "Your phone number was validated successfully");
        return redirect("/profile/twoFactor");
    }
}
