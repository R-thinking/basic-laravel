<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        $res=["data"=>["posts"=>[]]];

        foreach($posts as $post){
            $arr =[
                    "convertedID" => $post->id,
                    "createdAt" => $post->created_at,
                    "updatedAt" => $post->updated_at
            ];
            array_push($res["data"]["posts"], $arr); 
        }        

        return response()->json($res);
    }
}
