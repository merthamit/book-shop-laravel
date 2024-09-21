<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SingleController extends Controller
{
    public function index($id)
    {
        $book = Book::findOrFail($id);
        $books = Book::orderBy('hit', 'asc')->get();
        $comments = Comment::where('book_id', $id)->get();
        return view('front.single.single', compact('book', 'comments'));
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:3|max:300',
            'rating' => 'required|min:0|max:5',
        ]);

        $book = Book::findOrFail($id);
        $book->rating += $request->rating;
        $book->rating_count += 1;
        $book->save();

        $comment = new Comment;
        $comment->book_id = $id;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->rating = $request->rating;
        $comment->save();

        toastr()->success('Başarıyla yorum yapıldı.');
        return redirect()->back();
    }
    public function deleteComment($comment_id)
    {
        $comment = Comment::where('user_id', Auth::user()->id)->where('id', $comment_id)->first();
        if (!$comment) {
            return abort(404);
        }

        $book = Book::findOrFail($comment->book_id);
        $book->rating -= $comment->rating;
        $book->rating_count -= 1;
        $book->save();
        $comment->delete();

        toastr()->success('Başarıyla yorum silindi.');
        return redirect()->back();
    }
}
