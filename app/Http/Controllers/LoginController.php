<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthenticatePostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(AuthenticatePostRequest $request)
    {
        if (Auth::attempt($request)) {
            $userId = Auth::id();
            $userData = User::find($userId);
            $token = $userData->createToken($request->token_name);
            $authUser = [
                'name' => $userData->name,
                'email' => $userData->email,
                'password' => $userData->password,
                'token' => $token,
                'tokenType' => 'Bearer',
            ];
            return response()->json($authUser);
        }

        $error = [
            'title' => 'Error when authentica your user',
            'status' => 404,
        ];
        return response()->json($error);
    }

    public function register(RegisterPostRequest $request)
    {
        $response = [];
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if ($user->save()) {
            $response = [
                'title' => 'User registered correctly',
                'status' => 201,
            ];
            return response()->json($response);
        }
        // TODO: Revisar los diversos codigos http, para ver cual corresponde para este caso
        $response = [
            'title' => 'We had problem with your user registration',
            'status' => 500,
        ];
        return response()->json($response);
    }
}
