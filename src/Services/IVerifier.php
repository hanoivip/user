<?php

namespace Hanoivip\User\Services;

interface IVerifier
{
    // get verifier config
    public function init();
    // need manual validation
    public function needValidation();
    // add verifier address/value
    public function add($userId, $value);
    //
    public function remove($userId, $value);
    // validate verifier address/value
    public function validate($userId, $value, $validator);
    // start to verify user device by this verifier
    public function startVerify($userId, $deviceId);
    // do verify
    public function verify($userId, $deviceId, $verifier);
}

