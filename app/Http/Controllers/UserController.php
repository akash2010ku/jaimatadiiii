<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */





    public function createUser(Request $request)
    {
        try {
            $data=$request->all();
            $isValid=User::query()->select('email',$data['email']);
            if(!$isValid){
                $userData=User::query()->create($data);
                return response()->json(['message' => $data]);
            }else{
                return response()->json(['message'=>"User Already exists"]);
            }
        }catch(Exception $e){
            return $e;
        }
    }


    public function deleteUser(Request $request)
    {
        try {
            $data=$request->all();
            User::query()->where('name',$data['name'])->delete();
            return response()->json(['message'=>"User Deleted Successfully"]);
        }catch(Exception $e){
            return $e;
        }
    }


    public function updateUser(Request $request){
        try {
            $data=$request->all();
            User::query()->where('uuid',$data['uuid'])->update($data);
            return response()->json(['message'=>"User Updated Successfully"]);
        }catch(Excpection $e){
            return $e;
        }

    }


    public function userList(Request $request){
        try {
            $userList=User::all();
            return response()->json(['UserLisr'=>$userList]);
        }catch (Exception $e){
            return $e;
        }
    }

    //
}
