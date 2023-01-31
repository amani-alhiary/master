<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookUserController extends Controller
{
    public function index()
    {
         $books = Book::orderBy('id','desc')->paginate(5);
         $categories = Category::orderBy('id','desc')->paginate(5);

        return view('pages.shop', compact('books', 'categories'));
    }
    
}
