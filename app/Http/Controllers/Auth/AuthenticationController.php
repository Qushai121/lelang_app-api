<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticationLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(AuthenticationLoginRequest $request, User $user)
    {
        $reqDatas = $request->safe();

        try {
            $userDatas = $user->where("email", $reqDatas->email)->first();
            if ($userDatas == null) {
                return response()->json([
                    'status' => "422",
                    'message' => "Credential Doesn't match",
                ], 422);
            }

            if (Hash::check($reqDatas->password, $userDatas->password) != true) {
                return response()->json([
                    'status' => "422",
                    'message' => "Credential Doesn't match",
                ], 422);
            }

            return response()->json(
                [
                    'status' => "200",
                    'message' => "Login Successfully",
                    'data' => [
                        'name' => $userDatas->username,
                        'email' => $userDatas->email,
                        'accessToken' =>  $userDatas->createToken("access-token")->plainTextToken,
                    ]
                    ],200
            );
        } catch (\Exception $th) {
            return response(
                [
                    'status' => "500",
                    'message' => $th,
                ],
                500
            );
        }
    }

    public function register(AuthenticationLoginRequest $request, User $user)
    {
        $reqDatas = $request->safe();

        try {
            $user->password = Hash::make($reqDatas->password);
            $user->name = $reqDatas->username;
            $user->email = $reqDatas->email;
            $user->save();
            return response()->json(
                [
                    'status' => "200",
                    'message' => "Register Successfully",
                ],
                200
            );
        } catch (\Exception $th) {
            return response(
                [
                    'status' => "500",
                    'message' => "Unknow Error",
                ],
                500
            );
        }
    }
}
