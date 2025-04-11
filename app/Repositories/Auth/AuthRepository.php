<?php

namespace App\Repositories\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthRepository extends Controller {
    public function createUser ($data) {
        return User::create($data);
    }
}