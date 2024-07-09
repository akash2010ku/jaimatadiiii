<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class superAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStaff(Request $request)
    {
        try {
            $data = $request->all();

            // Check if the user already exists
            $alreadyExists = Staff::query()->where('email', $data['email'])->exists();

            if (!$alreadyExists) {
                $userData = Staff::query()->create($data);
                return response()->json(['message' => $userData]);
            } else {
                return response()->json(['message' => "staff already exists"], 400);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function deleteStaff(Request $request)
    {
        try {
            $data=$request->all();
            Staff::query()->where('email',$data['email'])->delete();
            return response()->json(['message'=>"Staff Deleted Successfully"]);
        }catch(Exception $e){
            return $e;
        }
    }

    public function updateStaff(Request $request){
        try {
            $data=$request->all();
            Staff::query()->where('uuid',$data['uuid'])->update($data);
            return response()->json(['message'=>"staff Updated Successfully"]);
        }catch(Excpection $e){
            return $e;
        }

    }


    public function staffList(Request $request){
        try {
            $staffList=Staff::all();
            return response()->json(['StaffList'=>$staffList]);
        }catch (Exception $e){
            return $e;
        }
    }

    public function createUser(Request $request)
    {
        try {
            $data = $request->all();

            // Check if the user already exists
            $alreadyExists = User::query()->where('email', $data['email'])->exists();

            if (!$alreadyExists) {
                $userData = User::query()->create($data);
                return response()->json(['message' => $userData]);
            } else {
                return response()->json(['message' => "User already exists"], 400);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function deleteUser(Request $request)
    {
        try {
            $data=$request->all();
            User::query()->where('email',$data['email'])->delete();
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
            return response()->json(['UserList'=>$userList]);
        }catch (Exception $e){
            return $e;
        }
    }







}
