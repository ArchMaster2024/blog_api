<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthenticatePostRequest;
use App\Http\Requests\Auth\RegisterPostRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(AuthenticatePostRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $userId = Auth::id();
            $user = User::find($userId);
            $token = $user->createToken($user->name);
            $authUser = [
                'name' => $user->name,
                'email' => $user->email,
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
        $password = Hash::make($request->password);
        $user->password = $password;
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
