<?php
namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hanoivip\User\Services\CredentialService;
use Hanoivip\User\Services\TwofaService;
use Hanoivip\User\Services\DeviceService;

class AppTwofa extends Controller
{
    protected $twofa;
    
    protected $devices;
    
    protected $users;
    
    public function __construct(
        TwofaService $twofa,
        DeviceService $devices,
        CredentialService $users)
    {
        $this->twofa = $twofa;
        $this->devices = $devices;
        $this->users = $users;
    }

    public function status()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $status = $this->twofa->getStatus($userId);
        $default = $this->twofa->getDefaultWay();
        $otherWays = TwofaService::WAYS;
        $userWays = [];
        if (!empty($status))
        {
            $userWays = $this->twofa->getUserWays($userId);
            $otherWays = $this->twofa->getOtherWays($userWays);
        }
        return ['error' => 0, 'message' => '', 'data' => 
            ['status' => $status, 'default' => $default, 
                'userWays' => empty($userWays) ? null : $userWays, 
                'otherWays' => empty($otherWays) ? null : $otherWays]];
    }
    // Turnoff & delete all ways
    public function turnoff()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $this->twofa->turnoff($userId);
        return ['error' => 0, 'message' =>  __('hanoivip.user::twofa.turn-off-success'), 'data' => []];
    }
    public function listDevices()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $devices = $this->twofa->getUserDevices($userId);
        return view('hanoivip::device', ['devices' => $devices]);
    }
    public function revokeDevices()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $this->twofa->revokeDevices($userId);
        return ['error' => 0, 'message' => 'success', 'data' => []];
    }
    public function revokeDevice(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $deviceId = $request->input('deviceId');
        $this->twofa->revokeDevice($userId, $deviceId);
        return view('hanoivip::twofa-success', ['message' => __('hanoivip.user::twofa.device.revoke-success')]);
    }
    // List all values of a way
    public function list(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $values = $this->twofa->list($userId, $way);
        return ['error' => 0, 'message' => '', 'data' => ['way' => $way, 'values' => $values]];
    }
    // Add value into a way
    public function beginAdd(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $init = $this->twofa->beginAdd($userId, $way);
        return ['error' => 0, 'message' => 'success', 'data' => ['way' => $way, 'init' => $init]];
    }
    public function add(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $value = $request->input('value');
        $result = $this->twofa->addValue($userId, $way, $value);
        if ($result === true)
        {
            return ['error' => 0, 'message' => 'success', 'data' => ['way' => $way, 'value' => $value]];
        }
        else
        {
            return ['error' => 1, 'message' => $result, 'data' => []];
        }
    }
    // Remove value from a way
    public function remove(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $value = $request->input('value');
        $result = $this->twofa->removeValue($userId, $way, $value);
        return ['error' => 0, 'message' => 'success', 'data' => []];
    }
    public function refresh(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        if ($way == 'code')
        {
            $this->twofa->addValue($userId, $way, 0);
            return response()->redirectToRoute('twofa.list', ['way' => $way]);
        }
        return view('hanoivip::twofa-refresh-failure');
    }
    // Validate new added value 
    public function validate1(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $value = $request->input('value');
        if (!$this->twofa->needValidate($way))
            abort(500, 'No need validation');
        $otp = $request->input('otp');
        $result = $this->twofa->validateValue($userId, $way, $value, $otp);
        if ($result === true)
        {
            return ['error' => 0, 'message' => __('hanoivip.user::twofa.validate.success'), 'data' => []];
        }
        else
        {
            return ['error' => 1, 'message' => __('hanoivip.user::twofa.validate.failure'), 'data' => []];
        }
    }
    

}
    