<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

use App\User;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except(['login', 'register', 'forgetPassword', 'resetPassword', 'resetPasswordByToken']);
    }

    public function login() {
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        // $user->sendActiveMail();
        // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $token = auth('api')->tokenById($user->id);
        $this->respondWithToken($token);

    }
    public function me()
    {
        $user = auth('api')->user();
        return response()->json($user);
    }
    protected function respondWithToken(string $token)
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth('api')->factory()->getTTL() * 60
        ]);
    }
}
