<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Orders;
use App\Models\ShopCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index()
    {

        $items = [];
        $id = Auth::user()->id;
        $dbItems = ShopCart::where('user_id', $id)->first();
        if (!$dbItems || $dbItems->items == '[]') {
            toastr()->error('Sepetinizde yeterince ürün yok.');
            return redirect()->back();
        }
        $items = json_decode($dbItems->items ?? '[]');
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }

        return view('front.checkout.stepone', compact('items', 'total'));
    }

    public function payout(Request $request)
    {
        $id = Auth::user()->id;
        $shopcart = ShopCart::where('user_id', $id)->first();

        $request->validate([
            'email' => 'required|min:3',
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'city' => 'required|min:3',
            'country' => 'required|min:3',
            'phone' => 'required|min:10',
            'add1' => 'required|min:3',
            'add2' => 'required|min:3',
            'postcode' => 'required|min:3',
        ]);

        foreach (json_decode($shopcart->items) as $item) {
            $book = Book::where('id', $item->item_id)->first();
            $book->stock -= $item->quantity;
            $book->save();
        }

        $newPayout = new Orders;
        $newPayout->name = $request->name;
        $newPayout->user_id = $id;
        $newPayout->lastname = $request->lastname;
        $newPayout->country = $request->country;
        $newPayout->city = $request->city;
        $newPayout->phone = $request->phone;
        $newPayout->email = $request->email;
        $newPayout->add1 = $request->add1;
        $newPayout->add2 = $request->add2;
        $newPayout->postcode = $request->postcode;
        $newPayout->items = $shopcart->items;
        $newPayout->total = $request->total;
        $newPayout->save();
        $shopcart->delete();

        toastr()->success('Siparişiniz başarıyla oluşturuldu.');
        return redirect()->route('my.orders');
    }
}
