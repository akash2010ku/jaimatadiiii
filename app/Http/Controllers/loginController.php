<?php

namespace App\Http\Controllers;



use App\Models\Registration;
use App\Models\Staff;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse|string
     */
    protected function generateJwtToken($user) {
        $payload = [

            'sub' => $user->id, // Subject of the token

        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

//    public function loginSuperAdmin(Request $request){
//        try {
//            $data = $request->all();
//
//            // Check if the user already exists
//            $verifyData =  Registration::query()->where('email', $data['email'] AND 'password',
//                $data['passord'] And 'type' ,$data['superadmin'])->exists();
//
//            if ($verifyData) {
//                //generate jwt token
//            } else {
//                return response()->json(['message' => "invalid Email or password"], 400);
//            }
//        } catch (Exception $e) {
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
//    }

    public function loginStaff(Request $request) {
        try {
            $data = $request->all();

            // Check if the user exists
            $staff = Staff::query()->
            where('email', $data['email'])->
            where('password', $data['password'])->
            first();
//            $results = Staff::table('staff')
//                ->where('email', $data['email'])
//                ->where('password', $data['password'])
//                ->get();

            // Verify the password
            if ($staff ) {
                // Generate JWT token
                $token = $this->generateJwtToken($staff);

                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['message' => "Invalid email or password"], 405);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }


    public function loginUser (Request $request){
        try {
            $data = $request->all();

            // Check if the user exists
            $user = User::where('email', $data['email'])->first();

            // Verify the password
            if ($user && Hash::check($data['password'], $user->password)) {
                // Generate JWT token
                $token = $this->generateJwtToken($user);

                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['message' => "Invalid email or password"], 400);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
