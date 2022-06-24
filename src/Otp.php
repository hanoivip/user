<?php

namespace Hanoivip\User;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    public function userSecure()
    {
        // TODO: phone & address?
        return $this->hasOne(UserSecure::class, 'email', 'address');
    }
}
