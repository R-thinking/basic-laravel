<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
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

    public function createUsers(Request $request)
    {
        $input = $request->all();
        $user = User::create([
            "id" => $input["convertedID"],
            "name" => $input["convertedName"],
            "email"=> $input["convertedEmail"],
            "email_verified_at" => "2023-12-11 10:35",
            "password" => $input["convertedPassword"],
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
    public function updateUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);
        foreach($request->all() as $key => $value){
            $user[$this->mapProperties($key)] = $value;
        }
       
        $user->save();

        return response()->json($user);
    }

    public function deleteUsers(Request $request)
    {
        $id = $request->input("id");
        $user = User::findOrFail($id);
        $user->delete();
       
        return response()->json($user);
    }
}
