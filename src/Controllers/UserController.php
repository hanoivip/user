<?php
namespace Hanoivip\User\Controllers;

use Hanoivip\User\Services\TwofaService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $twofa;
    
    public function __construct(TwofaService $twofa)
    {
        $this->twofa = $twofa;
    }

    public function index()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $status = $this->twofa->getStatus($userId);
        return view('hanoivip::user', ['status' => $status]);
    }
    
    public function towfa()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $status = $this->towfa()->getStatus($userId);
        $ways = $this->getVerifyWays($userId);
        return view('hanoivip:twofa', ['status' => $status, 'ways' => $ways]);
    }
}
    