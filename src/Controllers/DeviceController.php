<?php
namespace Hanoivip\User\Controllers;

use Hanoivip\User\Services\TwofaService;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    protected $twofa;
    
    public function __construct(
        TwofaService $twofa)
    {
        $this->twofa = $twofa;
    }

    public function index()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $devices = $this->twofa->getUserDevices($userId);
        return view('hanoivip::device', ['devices' => $devices]);
    }
    
}
    