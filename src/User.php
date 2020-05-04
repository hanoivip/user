<?php

namespace Hanoivip\User;

//use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //use HasApiTokens, Notifiable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findForPassport($emailUsernamePhone)
    {
        $user = User::where('email', $emailUsernamePhone)->get();
        if ($user->isEmpty())
        {
            // try with username
            $user = User::where('name', $emailUsernamePhone)->get();
            if ($user->isEmpty())
            {
                // try with phone number
                return null;
            }
        }
        return $user->first();
    }
}
