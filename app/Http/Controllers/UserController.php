<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    

    /**
     * 
     * @OA\Get (
     *     path="/api/users",
     *     tags={"User"},
     *     summary="get user list",
     *     description="get user list",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="200", description="Success",
     *      @OA\MediaType(
     *             mediaType="application/json",
     *            @OA\Schema (
     *                 type="object",
     *                 @OA\Property(property="message", type="string", description="message", example="null"),
     *                 @OA\Property(property="data", type="object",
     *                      @OA\Property(property="users", type="array",
     *                        @OA\Items(type="object",
     *                          @OA\Property(property="convertedID", type="integer", description="ID", example="testID"),
     *                          @OA\Property(property="convertedName", type="string", description="이름", example="tester"),
     *                          @OA\Property(property="convertedEmail", type="string", description="이메일", example="tester@test.com"),
     *                          @OA\Property(property="convertedPassword", type="string", description="비밀번호", example="testPassword"),
     *                          @OA\Property(property="convertedEmailVerifiedAt", type="string", description="인증일", example="2023-12-14"),
     *                          @OA\Property(property="convertedRememberToken", type="string", description="토큰", example="eyjjspdkfksjoejlksjdf"),
     *                          @OA\Property(property="createdAt", type="string", description="생성일", example="2023-12-14"),
     *                          @OA\Property(property="updatedAt", type="string", description="변경일", example="2023-12-14"),
     *                     )),
     *                 ),
     *             ),
     *         )
     *      ),
     *     @OA\Response(response="400", description="Fail")
     * )
     */
    public function getUsers()
    {
        $users = User::all();

        $res=["data"=>["users"=>[]]];

        foreach($users as $user){
            $arr =[
                    "convertedID" => $user->id,
                    "convertedName" => $user->name,
                    "convertedEmail" => $user->email,
                    "convertedEmailVerifiedAt" => $user->email_verified_at,
                    "convertedPassword" => $user->password,
                    "convertedRememberToken" => $user->remember_token,
                    "createdAt" => $user->created_at,
                    "updatedAt" => $user->updated_at
            ];
            array_push($res["data"]["users"], $arr); 
        }        

        return response()->json($res);
    }

   /**
     * @OA\Post (
     *     path="/api/users",
     *     tags={"User"},
     *     summary="create user list",
     *     description="create user list",
     *     @OA\RequestBody(
     *         description="user information",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema (
     *                 type="object",
     *                 @OA\Property(property="user", type="object",
     *                      @OA\Property(property="convertedID", type="integer", description="ID", example="testID"),
     *                      @OA\Property(property="convertedName", type="string", description="이름", example="tester"),
     *                      @OA\Property(property="convertedEmail", type="string", description="이메일", example="tester@test.com"),
     *                      @OA\Property(property="convertedPassword", type="string", description="비밀번호", example="testPassword"),
     *                      @OA\Property(property="convertedEmailVerifiedAt", type="string", description="인증일", example="2023-12-14"),
     *                      @OA\Property(property="convertedRememberToken", type="string", description="토큰", example="eyjjspdkfksjoejlksjdf"),
     *                      @OA\Property(property="createdAt", type="string", description="생성일", example="2023-12-14"),
     *                      @OA\Property(property="updatedAt", type="string", description="변경일", example="2023-12-14"),
     *                 ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema (
     *                 type="object",
     *                 @OA\Property(property="message", type="string", description="message", example="null"),
     *                 @OA\Property(property="data", type="object",
     *                      @OA\Property(property="user", type="object",
     *                          @OA\Property(property="convertedID", type="integer", description="ID", example="testID"),
     *                          @OA\Property(property="convertedName", type="string", description="이름", example="tester"),
     *                          @OA\Property(property="convertedEmail", type="string", description="이메일", example="tester@test.com"),
     *                          @OA\Property(property="convertedPassword", type="string", description="비밀번호", example="testPassword"),
     *                          @OA\Property(property="convertedEmailVerifiedAt", type="string", description="인증일", example="2023-12-14"),
     *                          @OA\Property(property="convertedRememberToken", type="string", description="토큰", example="eyjjspdkfksjoejlksjdf"),
     *                     ),
     *                 ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(response="400", description="Fail")
     * )
     */
    public function createUsers(Request $request)
    {
        $input = $request->all();
        $userInfo = $input["user"];
        $user = User::create([
            "id" => $userInfo["convertedID"],
            "name" => $userInfo["convertedName"],
            "email"=> $userInfo["convertedEmail"],
            "email_verified_at" => "2023-12-11 10:35",
            "password" => $userInfo["convertedPassword"],
            "remember_token" => "asdasdasd",
            /* "created_at" => "2023-12-11 10:35",
            "updated_at" => "2023-12-11 10:35", */
        ]);
       
        return response()->json($user);
    }

    public function mapProperties($property){
       switch($property){
            case "convertedID":
                return "id";
            case "convertedName":
                return "name";
            case "convertedEmail":
                return "email";
            case "convertedEmailVerifiedAt":
                return "email_verified_at";
            case "convertedPassword":
                return "password";
            case "convertedRememberToken":
                return "remember_token";
            case "createdAt":
                return "created_at";
            case "updatedAt":
                return "updated_at";
       }
    }   

    /**
     * @OA\Put (
     *     path="/api/users/{userID}",
     *     tags={"User"},
     *     summary="update user",
     *     description="update user",
     *     @OA\Parameter(
     *         name="userID",
     *         in="path",
     *         required=true,
     *         description="유저 ID",
     *         @OA\Schema(type="integer",example="2"),
     *     ),
     *     @OA\RequestBody(
     *         description="update information",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",       
     *             @OA\Schema (
     *                 @OA\Property (property="convertedName", type="string", description="이름", example="tester"),
     *                 @OA\Property (property="convertedEmail", type="string", description="이메일", example="tester2@test.com"),
     *                 @OA\Property (property="convertedPassword", type="string", description="비밀번호", example="testPassword"),
     *                 @OA\Property (property="convertedEmailVerifiedAt", type="string", description="인증일", example="2023-12-14"),
     *                 @OA\Property (property="convertedRememberToken", type="string", description="토큰", example="eyjjspdkfksjoejlksjdf"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="400", description="Fail")
     * )
     */
    public function updateUsers(Request $request, $userID)
    {
        $user = User::findOrFail($userID);
        foreach($request->all() as $key => $value){
            $user[$this->mapProperties($key)] = $value;
        }
       
        $user->save();

        return response()->json($user);
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{userID}",
     *     tags={"User"},
     *     summary="delete user",
     *     description="delete user",
     *     @OA\Parameter(
     *         name="userID",
     *         in="path",
     *         required=true,
     *         description="유저 ID",
     *         @OA\Schema(type="integer",example="2"),
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="400", description="Fail")
     * )
     */
    public function deleteUsers(Request $request,$userID)
    {
        // $id = $request->input("id");
        $user = User::findOrFail($userID);
        $user->delete();
       
        return response()->json($user);
    }
}
