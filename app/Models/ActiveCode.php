<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    protected $fillable = [
        "code",
        "user_id",
        "expire_at"
    ];
    public $timestamps = false;

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGenerateCode($query, $user)
    {
        if($code = $this->getUserActiveCode($user)) {
            $code = $code->code;
        } else {
            do {
                $code = mt_rand(1111, 9999);
            } while($this->checkCodeIsUnique($user, $code));

            // store the code
            $user->activeCode()->create([
                'code' => $code,
                'expire_at' => now()->addMinutes(15),
            ]);
        }

        return $code;
    }

    public function getUserActiveCode($user)
    {
        return $user->activeCode()->where("expire_at", ">", now())->first();
    }

    public function checkCodeIsUnique($user, int $code)
    {
        return !! $user->activeCode()->whereCode($code)->first();
    }

    public function scopeVerifyCode($query, $user, $code)
    {
        return !! $user->activeCode()->whereCode($code)->where("expire_at", ">", now())->first();
    }
}
