<?php

namespace App\Services\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\PendingUser;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends Controller {
    public $authRepository;
    public $user;

    public function __construct (AuthRepository $authRepository) {
        return $this->authRepository = $authRepository;
    }

    public function register ($request) {
        $otp = rand(100000, 900000);
        PendingUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'otp'      => $otp
        ]);
        Mail::to($request->email)->send(new SendOtpMail($otp));
        return $request->email;
    }

    public function verifyAccount ($request) {
        $pendingUser = PendingUser::where('email' , $request->email)->first();
        if (!$pendingUser) {
            return null;
        }
        $data = [
            'name'              => $pendingUser->name,
            'email'             => $pendingUser->email,
            'password'          => $pendingUser->password,
            'email_verified_at' => now()
        ];
        if ($request->otp == $pendingUser->otp) {
            $user   = $this->authRepository->createUser($data);
            $this->user = $user;
            $pendingUser->delete();
        }
        return $pendingUser;
    }

    public function login () {
        $credentials = request(['email', 'password']);
        return Auth::attempt($credentials);
    }

    public function profile () {
        return auth::user();
    }

    public function refresh () {
        $oldToken = JWTAuth::getToken();
        if (!$oldToken || !JWTAuth::check()) {
            return null;
        }
        $newToken = JWTAuth::refresh();
        return $newToken;
    }

    public function logout () {
        $user = auth::user();
        if (!$user) {
            return null;
        }
        auth::logout();
        return $user;
    }

}