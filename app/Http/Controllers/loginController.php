<?php

namespace App\Http\Controllers;



use App\Models\Registration;
use App\Models\Staff;
use Illuminate\Http\Request;

class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function loginSuperAdmin(Request $request){
        try {
            $data = $request->all();

            // Check if the user already exists
            $verifyData =  Registration::query()->where('email', $data['email'] AND 'password',
                $data['passord'] And 'type' ,$data['superadmin'])->exists();

            if ($verifyData) {
                //generate jwt token
            } else {
                return response()->json(['message' => "invalid Email or password"], 400);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loginStaff (Request $request){
        try{
            $data=$request->all();
            $verifyData=Staff::query()->where()->exists();

            if($verifyData){
                //gernerate jwt token
            }else{
                return response()->json(['message'=>"Invalid email or password"],400);
            }
        }catch(\Exception $exception){
            return $exception;

        }
    }


    public function loginUser (Request $request){
        try{
            $data=$request->all();
            $verifyData=Staff::query()->where()->exists();

            if($verifyData){
                //gernerate jwt token
            }else{
                return response()->json(['message'=>"Invalid email or password"],400);
            }
        }catch(\Exception $exception){
            return $exception;

        }
    }
}
