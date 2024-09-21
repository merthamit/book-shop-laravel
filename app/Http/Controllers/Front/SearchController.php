<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all();
        $booksQuery = Book::orderBy('id', 'asc');
        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $booksQuery->where('category_id', $category->id);
            }
        }

        if ($request->pages) {
            $pageCount = explode('-', $request->pages);
            if (count($pageCount) != 2) {
                $pageCount[0] = 0;
                $pageCount[1] = 5000;
            }
            foreach ($pageCount as $page) {
                if (!is_int((int) $page)) {
                    $pageCount[0] = 0;
                    $pageCount[1] = 5000;
                    break;
                }
            }
            $booksQuery->whereBetween('page_count', [(int) $pageCount[0], (int) $pageCount[1]]);
        }
        if ($request->min && $request->max) {
            if (is_int((int) $request->min) && is_int((int) $request->max)) {
                $booksQuery->whereBetween('price', [$request->min, $request->max]);
            }
        }
        $books = $booksQuery->paginate(9)->withQueryString();
        $oldInput = ['category' => $request->category, 'max' => $request->max, 'min' => $request->min, 'pages' => $request->pages];
        return view('front.search.search', compact('books', 'categories', 'oldInput'));
    }

}
