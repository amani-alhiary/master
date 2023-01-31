<?php

namespace App\Http\Controllers;
use App\Models\UserBook;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class UsedBooksController extends Controller
{
    public function index()
    {

        $books = UserBook::orderBy('id','desc')->where('is_sold','0')->paginate(100);
        return view('pages.userbooksshop', compact('books'));
    }

    public function show(Request $request)
    {
        $books = UserBook::findOrFail($request['id']);
        
        $book = $books->orderByDesc('id')->where('id',$request['id'])->paginate(5);
        $realtedbooks = $books->where('category_id',$book[0]->category_id)->paginate(6);

        $user=DB::table('user_books')
          ->select('*')
          ->join('users','users.id','=','user_books.user_id')
          ->where('users.id','=',$book[0]->user_id)
          ->get();
  
        return view('pages.userbookdetails', compact('book','realtedbooks','user'));

        }

}
