<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\User;
class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['unauthorized', 'login']]);
        $this->guard = "api";
    }

    public function login(Request $request){
        $login = $request->login;
        $credentials = array('email'=> $login['email'], 'password'=> $login['password']);
        //$credentials = request(['email', 'password']);
        if (! $token = auth($this->guard)->attempt($credentials)) {
            return 'NO AUTORIZADO';
        }

        $userController = new UserController();
        $user  = $userController->email($login['email']);
        return $this->respondWithToken($token, $user);
    }

    public function me() {
        return auth($this->guard)->user();
    }

    public function logout() {
        auth($this->guard)->logout();
        return 'SESSION CERRADA';
    }

    public function refresh() {
        return auth($this->guard)->refresh();
    }

    protected function respondWithToken($token, $user) {
        return [
            'user' => $user,
            'token' => $token,
            'type'  => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ];

    }

    public function unauthorized() {
        return 'NO AUTORIZADO';

    }
}
