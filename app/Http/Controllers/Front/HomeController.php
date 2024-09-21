<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\HeroContext;
use App\Models\ParallaxContext;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('hit', 'asc')->limit(8)->get();
        $booksRating = Book::orderByRaw('rating / rating_count desc')->limit(8)->get();
        $hero = HeroContext::first();
        $parallax = ParallaxContext::first();
        return view('front.Home.home', compact('books', 'hero', 'parallax', 'booksRating'));
    }
}
