<?php

use App\Models\Machine;
use App\Models\ServiceReport;
use App\Models\touchstarUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get("/history/service/report",function(Request $req){

    if(Auth::guard("sanctum")->check()){
        #Get all Machines
        $machines = Machine::all();

        #Get 250 Service Report
        $service_report = ServiceReport::offset(0)->limit(250)->get()->all();

        $data = [
            "machines" => $machines,
            "service_report" => $service_report
        ];
        return response()->json($data);
    }else{
        return response()->json(["code"=>"401","message"=>"Unauthorized Access"]);
    }
});

Route::post("/test",function(Request $req){
    dd(Auth::guard("sanctum")->check());
});
