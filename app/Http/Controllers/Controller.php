<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*     title="hojun API Docs", version="0.1", description="Example API Documentation",
*     @OA\Contact(
*         email="example@test.com",
*         name="Email"
*     )
* )
* 
* @OA\SecurityScheme(
*     securityScheme="bearerAuth",
*     description="Authorization",
*     name="Authorization",
*     in="header",
*     type="http",
*     scheme="bearer",
*     bearerFormat="JWT",
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
