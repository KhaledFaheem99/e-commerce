<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UserCreateRequest;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Services\Auth\AuthService;

class AuthController extends ApiController {
    public $authService;

    public function __construct (AuthService $authService) {
        return $this->authService = $authService;
    }

    
    public function sendRegisterOtp (UserCreateRequest $request) {
        $email = $this->authService->register($request);
        return $this->successResponse("The Otp Sended To Your Account Pls Verify Your Account" , "Your Accoutn Is ($email)" , 200);
    }

    public function verifyAccount (VerifyAccountRequest $request) {
        $pendingUser = $this->authService->verifyAccount($request);
        if (!$pendingUser){
            return $this->failedResponse('Invalid Request' , 400);
        }   
        if ($request->otp != $pendingUser->otp) {
            return $this->failedResponse('Invalid Otp' , 400);
        }
        return $this->successResponse("User Created Successfully" , $this->authService->user , 200);
    }

    public function login (LoginRequest $request) {
        $token = $this->authService->login($request);
        if (!$token) {
            return $this->failedResponse('Unauthorized' , 401);
        }
        return $this->successResponse('User Login Is Successfully' , auth::user() , 200 , $token);
    }

    public function profile () {
        $user = $this->authService->profile();
        if (!$user){
        return $this->failedResponse('The Token Is Invalid' , 400);
        }
        return $this->successResponse('The Profile Information Is Fetched' , auth::user() , 200);
    }
    
    public function refresh () {
        $newToken = $this->authService->refresh();
        if (!$newToken){
        return $this->failedResponse('The Token Is Invalid Or Expired' , 400);
        }
        return $this->successResponse('The Token Refreshed Successfully' , $newToken , 200);
    }

    public function logout () {
        $user = $this->authService->logout();
        if (!$user) {
            return $this->failedResponse('Failed logout' , 400);
        }
        return $this->successResponse('Successfully logged out' , $user , 200);
    }


}