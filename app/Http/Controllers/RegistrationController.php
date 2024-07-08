<?php

namespace App\Http\Controllers;

use App\Models\Registration;

use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(Request $request)
    {
        try {
            $data = $request->all();

            // Check if the user already exists
            $alreadyExists = Registration::query()->where('email', $data['email'])->exists();

            if (!$alreadyExists) {
                $userData = Registration::query()->create($data);
                return response()->json(['message' => $userData]);
            } else {
                return response()->json(['message' => "User already exists"], 400);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




}
