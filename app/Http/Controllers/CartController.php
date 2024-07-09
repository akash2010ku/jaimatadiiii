<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy(Request $request)
    {
        $data = $request->all();
        $update = Books::query()
            ->where('id', $data['id'])
            ->update(['user_id' => $data['user_id'],
                'issued'=>'1']);

        return response()->json(['Data'=>$update]);
    }

    public function showBoughtBooks(Request $request){
        $data=$request->all();
        $result= User::query();
    }

    //
}
