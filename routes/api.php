<?php

use App\Models\touchstarUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post("/login/auth",function(Request $req){
    $email = $req->input("email");
    $password = $req->input("password");

    $user = touchstarUser::where("touch_acc_email",$email)->first();
    $isCorrect = Hash::check($password,$user->password);
    if($isCorrect){
        $token = $user->createToken("logintoken")->plainTextToken;
        return response()->json(["code"=>200,"_token"=>$token]);
    }else{
        return response()->json(["code"=>404,"error"=>"404 Not Found"]);
    }
});

Route::post("/test",function(Request $req){
    return response("test");
})->middleware(["auth:sanctum"]);
