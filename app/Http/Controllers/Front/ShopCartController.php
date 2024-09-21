<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ShopCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopCartController extends Controller
{
    public function index()
    {
        $items = [];
        $id = Auth::user()->id;
        $dbItems = ShopCart::where('user_id', $id)->first();
        $items = json_decode($dbItems->items ?? '[]');
        return view('front.shop_cart.shop_cart', compact('items'));
    }

    public function addCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'item_id' => 'required',
        ]);

        $newItem = $request->only('user_id', 'title', 'price', 'quantity', 'item_id', 'image');

        $id = Auth::user()->id;
        $dbItems = ShopCart::where('user_id', $id)->first();
        if (!$dbItems) {
            $newDb = new ShopCart;
            $newDb->user_id = $id;
            $newDb->save();
            $dbItems = ShopCart::where('user_id', $id)->first();
        }
        $items = json_decode($dbItems->items, true);
        foreach ($items as &$item) {
            if ($item['item_id'] == $newItem['item_id']) {
                $item['quantity'] += $newItem['quantity'];
                $dbItems->items = json_encode($items);
                $dbItems->save();
                toastr()->success('Başarıyla ürün eklendi.');
                return redirect()->route('shop.cart');
            }
        }
        unset($item);
        $items[] = $newItem;

        $dbItems->items = json_encode($items);
        $dbItems->save();

        toastr()->success('Başarıyla ürün eklendi.');
        return redirect()->route('shop.cart');
    }
    public function deleteCart($id)
    {
        $userId = Auth::user()->id;
        $dbItems = ShopCart::where('user_id', $userId)->first();
        if (!$dbItems) {
            return redirect()->route('shop.cart')->with('error');
        }

        $itemsJson = json_decode($dbItems->items, true);
        $items = array_filter($itemsJson, fn($item) => $item['item_id'] != $id);

        $dbItems->items = json_encode($items);
        $dbItems->save();

        toastr()->success('Başarıyla ürün silindi.');
        return redirect()->route('shop.cart');
    }
}
