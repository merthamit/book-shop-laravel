<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Footer;
use App\Models\HeroContext;
use App\Models\Orders;
use App\Models\ParallaxContext;
use App\Models\ShopCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdminPanelController extends Controller
{
    public function index()
    {
        $ordersCount = Orders::all()->count();
        $booksCount = Book::all()->count();
        $commentsCount = Comment::all()->count();
        $userCount = User::all()->count();
        return view('back.home.home', compact('ordersCount', 'booksCount', 'commentsCount', 'userCount'));
    }
    public function hero()
    {
        $hero = HeroContext::first();
        return view('back.hero.hero', compact('hero'));
    }
    public function footer()
    {
        $footer = Footer::first();
        return view('back.footer.footer', compact('footer'));
    }
    public function users()
    {
        $users = User::all();
        return view('back.users.users', compact('users'));
    }
    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if ($user->usertype == 'admin') {
            toastr()->error('Admin silinemez.');
            return redirect()->route('users');
        }

        $user->delete();

        toastr()->success('Başarıyla silindi.');
        return redirect()->route('users');
    }
    public function footerUpdate(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10|max:50',
            'address' => 'required|min:10|max:250',
            'mission' => 'required|min:10|max:250',
            'email' => 'required|max:30',
        ]);

        $footer = Footer::first();
        $footer->phone = $request->phone;
        $footer->address = $request->address;
        $footer->mission = $request->mission;
        $footer->email = $request->email;
        $footer->save();

        toastr()->success('Başarıyla kaydedildi.');
        return redirect()->back()->with('message', 'Başarılı şekilde kaydedildi.');
    }
    public function heroUpdate(Request $request)
    {
        $request->validate([
            'header_big' => 'required|min:10|max:50',
            'header_medium' => 'required|min:10|max:50',
            'header_small' => 'required|min:10|max:250',
            'button_name' => 'required|max:30',
        ]);

        $hero = HeroContext::first();
        $hero->header_big = $request->header_big;
        $hero->header_medium = $request->header_medium;
        $hero->header_small = $request->header_small;
        $hero->button_name = $request->button_name;
        $hero->save();

        toastr()->success('Başarıyla kaydedildi.');
        return redirect()->route('hero');
    }
    public function parallax()
    {
        $parallax = ParallaxContext::first();
        return view('back.parallax.parallax', compact('parallax'));
    }
    public function parallaxUpdate(Request $request)
    {
        $request->validate([
            'header_big' => 'required|min:10|max:50',
            'header_medium' => 'required|min:10|max:50',
            'header_small' => 'required|min:10|max:250',
            'button_name' => 'required|max:30',
        ]);

        $hero = ParallaxContext::first();
        $hero->header_big = $request->header_big;
        $hero->header_medium = $request->header_medium;
        $hero->header_small = $request->header_small;
        $hero->button_name = $request->button_name;
        $hero->save();

        toastr()->success('Başarıyla kaydedildi.');
        return redirect()->route('parallax');
    }

    public function books()
    {
        $books = Book::all();
        return view('back.books.books', compact('books'));
    }
    public function bookDelete($id)
    {
        $book = Book::findOrFail($id);
        $users = User::all();
        // Big O yu biliyorum ama çok fazla kullanıcı olmayacağını düşünerek böyle yapılmıştır.
        foreach ($users as $user) {
            $userId = $user->id;
            $dbItems = ShopCart::where('user_id', $userId)->first();
            if (!$dbItems) {
                continue;
            }
            $itemsJson = json_decode($dbItems->items, true);
            $items = array_filter($itemsJson, fn($item) => $item['item_id'] != $id);

            $dbItems->items = json_encode($items);
            $dbItems->save();
        }
        if (File::exists(public_path($book->image))) {
            File::delete(public_path($book->image));
        }
        $book->delete();

        toastr()->success('Başarıyla silindi.');
        return redirect()->route('books');
    }
    public function bookUpdate(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($request->hasFile('image')) {
            if (File::exists(public_path($book->image))) {
                File::delete(public_path($book->image));
            }
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $image = $request->file('image');
            $image->move(public_path('/uploads/cover/'), $imageName);
            $imagePath = public_path('/uploads/cover/');

            $book->image = '/uploads/cover/' . $imageName;

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read(public_path('/uploads/cover/') . $imageName);
            $thumbImage->resize(250, 250);
            $thumbImage->save($imagePath . $imageName);
        }

        $book->title = $request->title;
        $book->slug = str_slug($request->title);
        $book->author = $request->author;
        $book->language = $request->language;
        $book->page_count = $request->page_count;
        $book->category_id = $request->category_id;
        $book->release_date = $request->release_date;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->content = $request->content;
        $book->brief = $request->brief;
        $book->save();

        toastr()->success('Başarıyla güncellendi.');
        return redirect()->route('books');
    }
    public function addBook(Request $request)
    {
        $book = new Book;
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $image = $request->file('image');
            $image->move(public_path('/uploads/cover/'), $imageName);
            $imagePath = public_path('/uploads/cover/');

            $book->image = '/uploads/cover/' . $imageName;

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read(public_path('/uploads/cover/') . $imageName);
            $thumbImage->resize(250, 250);
            $thumbImage->save($imagePath . $imageName);
        }
        $book->title = $request->title;
        $book->slug = str_slug($request->title);
        $book->author = $request->author;
        $book->language = $request->language;
        $book->page_count = $request->page_count;
        $book->category_id = $request->category_id;
        $book->release_date = $request->release_date;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->content = $request->content;
        $book->brief = $request->brief;
        $book->save();

        toastr()->success('Başarıyla kitap eklendi.');
        return redirect()->route('books');
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->name) . '.' . $request->image->getClientOriginalExtension();
            $image = $request->file('image');
            $image->move(public_path('uploads/cover'), $imageName);
            $imagePath = public_path('/uploads/cover/');

            $book->image = '/uploads/cover/' . $imageName;

            $imgManager = new ImageManager(new Driver());
            $thumbImage = $imgManager->read('/uploads/cover/' . $imageName);
            $thumbImage->resize(250, 250);
            $thumbImage->save($imagePath . $imageName);
        }
        $book->title = $request->title;
        $book->slug = str_slug($request->title);
        $book->author = $request->author;
        $book->language = $request->language;
        $book->page_count = $request->page_count;
        $book->category_id = $request->category_id;
        $book->release_date = $request->release_date;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->content = $request->content;
        $book->brief = $request->brief;
        $book->save();

        toastr()->success('Başarıyla kitap güncellendi.');
        return redirect()->route('books');
    }
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('back.books.create', compact('categories'));
    }
    public function update($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('back.books.update', compact('book', 'categories'));
    }
    public function orders()
    {
        $orders = Orders::all();
        return view('back.orders.orders', compact('orders'));
    }
    public function comments()
    {
        $comments = Comment::all();
        return view('back.comments.comments', compact('comments'));
    }
    public function commentDelete($id)
    {
        $comment = Comment::findOrFail($id);
        $book = Book::findOrFail($comment->book_id);
        $book->rating -= $comment->rating;
        $book->rating_count -= 1;
        $book->save();
        $comment->delete();

        toastr()->success('Başarılı bir şekilde silindi.');
        return redirect()->route('comments');
    }
    public function orderCancel($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();
        toastr()->success('Başarıyla iptal edildi.');
        return redirect()->route('orders');
    }
}
