<?php

namespace Hanoivip\User;

use Illuminate\Database\Eloquent\Model;

class UserSecure extends Model
{
    protected $primaryKey = 'user_id';
    
    public function otps()
    {
        return $this->hasMany(Otp::class, 'address', 'email');
    }
}
