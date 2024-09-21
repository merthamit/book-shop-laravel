<?php

namespace App\Http\View\Composers;

use App\Models\ShopCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CountComposer
{
    public function compose(View $view)
    {
        $count = 0;

        if (Auth::check()) {
            $dbShopCart = ShopCart::where('user_id', Auth::id())->first();
            $count = $dbShopCart ? count(json_decode($dbShopCart->items, true)) : 0;
        }

        $view->with('count', $count);
    }
}
