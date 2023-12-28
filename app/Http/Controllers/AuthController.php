<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
   
    /**
     * 
     * @OA\Get (
     *     path="/api/auth/login",
     *     tags={"User"},
     *     summary="get user list",
     *     description="get user list",
     *     @OA\Response(response="200", description="Success",
     *      @OA\MediaType(
     *             mediaType="application/json",
     *            @OA\Schema (
     *                 type="object",
     *                 @OA\Property(property="message", type="string", description="message", example="null"),
     *                 @OA\Property(property="data", type="object",
     *                      @OA\Property(property="users", type="array",
     *                        @OA\Items(type="object",
     *                          @OA\Property(property="access_token", type="integer", description="ID", example="testID"),
     *                          @OA\Property(property="token_type", type="string", description="이름", example="tester"),
     *                          @OA\Property(property="expires_in", type="string", description="이메일", example="tester@test.com"),
     *                     )),
     *                 ),
     *             ),
     *         )
     *      ),
     *     @OA\Response(response="400", description="Fail")
     * )
     */
    public function login(Request $request){
        $credentials = $request->only("email","password");

         //valid credential
         $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'status' => 0], 200);
        }

        $token = JWTAuth::attempt($credentials);
        if(!$token){
            return response()->json(["error" => "Unauthorized"],401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);
        return $this->respondWithToken($token);
    }

    protected function respondeWithToken($token){
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => JWTAuth::factory()->getTTL() * 6000
        ]);
    }

   
}
