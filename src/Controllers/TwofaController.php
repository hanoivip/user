<?php
namespace Hanoivip\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hanoivip\User\Services\TwofaService;

class TwofaController extends Controller
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
        $status = $this->twofa->getStatus($userId);
        $default = $this->twofa->getDefaultWay();
        $otherWays = [];
        $userWays = [];
        if (!empty($status))
        {
            $userWays = $this->twofa->getUserWays($userId);
            $otherWays = $this->twofa->getOtherWays($userWays);
        }
        return view('hanoivip::twofa', 
            ['status' => $status, 'default' => $default,
                'userWays' => $userWays, 'otherWays' => $otherWays]);
    }
    // Turnoff & delete all ways
    public function turnoff()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $this->twofa->turnoff($userId);
        return view('hanoivip::twofa-turnoff');
    }
    public function revokeDevices()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $this->twofa->revokeDevices($userId);
        return view('hanoivip::twofa-revoke-devices');
    }
    // List all values of a way
    public function list(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $values = $this->twofa->list($userId, $way);
        return view("hanoivip::twofa-list-$way", ['way' => $way, 'values' => $values]);
    }
    // Add value into a way
    public function add(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        if ($request->getMethod() == 'POST')
        {
            $value = $request->input('value');
            $result = $this->twofa->addValue($userId, $way, $value);
            if ($this->twofa->needValidate($way))
            {
                return view('hanoivip::twofa-validate-value', 
                    ['way' => $way, 'value' => $value]);
            }
            else
            {
                return view('hanoivip::twofa-add-success');
            }
        }
        else 
        {
            $init = $this->twofa->beginAdd($userId, $way);
            return view("hanoivip::twofa-add-value-$way", ['way' => $way, 'init' => $init]);
        }
    }
    // Remove value from a way
    public function remove(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $value = $request->input('value');
        $result = $this->twofa->removeValue($userId, $way, $value);
        return view('hanoivip::twofa-remove-success');
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
    public function download(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $result = $this->twofa->refreshValue($userId, $way);
        return view('hanoivip::twofa-remove-success');
    }
    // Validate new added value 
    public function validate1(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $way = $request->input('way');
        $value = $request->input('value');
        if ($request->getMethod() == 'POST')
        {
            if (!$this->twofa->needValidate($way))
                abort(500, 'No need validation');
            $otp = $request->input('otp');
            $result = $this->twofa->validateValue($userId, $way, $value, $otp);
            return view('hanoivip::twofa-success');
        }
        else
        {
            
            return view('hanoivip::twofa-validate-value', ['way' => $way, 'value' => $value]);
        }
    }
    // Verify user device UI
    public function verify(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $device = $request->get('device');
        if ($request->has('way'))
            $way = $request->input('way');
        else 
            $way = $this->twofa->getDefaultWay();
        $this->twofa->startVerifyDevice($userId, $way, $device);
        return view('hanoivip::twofa-verify', ['way' => $way]);
    }
    
    public function doVerify(Request $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $device = $request->get('device');
        $way = $request->input('way');
        $otp = $request->input('otp');
        $this->twofa->verify($userId, $device, $way, $otp);
        if ($request->has('redirect'))
            return response()->redirectTo($request->input('redirect'));
        else 
            return response()->redirectToRoute('home');
    }
}
    