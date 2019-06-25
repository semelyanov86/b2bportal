<?php

namespace Modules\Cart\Http\Controllers;

use Modules\Support\Country;
use Modules\Cart\Facades\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::instance();
        $countries = Country::supported();
        $cart->updateContract();

        return view('public.cart.index', compact('cart', 'countries'));
    }


    public function unlink()
    {
        $currentOrder = Session::get('CurrentOrder');
        if ($currentOrder) {
            Session::remove('CurrentOrder');
            Session::pull('CurrentOrder');
            Cart::clear();
        }
        return back();
    }
}
