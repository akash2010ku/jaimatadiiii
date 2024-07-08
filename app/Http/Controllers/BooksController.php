<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\User;
use Carbon\Exceptions\ParseErrorException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class BooksController extends Controller
{
    /**
     *
     *
     *
     *
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBook(Request $request)
    {
        try {
            $body=$request->all();
            $createdbook=Books::query()->create($body);
            return response()->json(['message'=>$createdbook]);
        }catch (\Exception $exception){
            return $exception;
        }

    }


    public function deleteBook(Request $request)
    {
        try {
            $body=$request->all();
            Books::query()->where('name',$body['name'])->delete();
            return response()->json(['message'=>"Book Deleted Successfully"]);

        }catch (Exception $exception){
            return $exception;
        }
    }


    public function updateBook(Request $request)
    {
        try {
            $body=$request->all();
            Books::query()->where('name',$body['name'])->update($body);
            return response()->json(['message'=>'Book updated successfuly']);

        }catch (Exception $exception){
            return $exception;
        }
        }

        public function bookList(Request $request){
            try {
                $bookList=Books::all();
                return response()->json(['BookList'=>$bookList]);

            }catch (\Exception $exception){
                return $exception;
            }
        }
    //
}
