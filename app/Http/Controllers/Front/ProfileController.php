<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function orders()
    {
        $id = Auth::user()->id;
        $userOrders = Orders::where('user_id', $id)->get();

        return view('front.profile.orders.orders', compact('userOrders'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $userComments = Comment::where('user_id', $id)->get();

        return view('front.profile.profile.profile', compact('userComments'));
    }
    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $request->validate([
            'new_password_confirm' => 'max:30',
            'new_password' => 'max:30',
            'old_password' => 'max:30',
            'email' => 'required|max:60|email',
            'name' => 'required|max:30',
        ]);

        if (($request->new_password == $request->new_password_confirm) && Hash::check($request->old_password, $user->password)) {
            if (strlen($request->new_password) < 5) {
                toastr()->error('Yeni şifre 5 karakterden az olamaz.');
                return redirect()->back();

            }

            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
            toastr()->success('Şifre güncellendi.');
        }
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);
        toastr()->success('İsim ve Email başarılı şekilde güncellendi.');
        return redirect()->back();
    }

    public function orderCancel($orderId)
    {
        $id = Auth::user()->id;
        $userOrders = Orders::where('user_id', $id)->where('id', $orderId)->first();
        foreach (json_decode($userOrders->items) as $item) {
            $book = Book::where('id', $item->item_id)->first();
            $book->stock += $item->quantity;
            $book->save();
        }
        $userOrders->delete();

        toastr()->success('Sipariş başarıyla iptal oldu.');
        return redirect()->route('my.orders');
    }

}
