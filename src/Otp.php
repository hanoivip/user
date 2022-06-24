<?php

namespace Hanoivip\User;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    public function userSecure()
    {
        // TODO: phone & address?
        return $this->belongsTo(UserSecure::class, 'address', 'email');
    }
}
