<?php

namespace Modules\Contract\Http\Controllers;

use http\Client\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Contract\Entities\Contract;
use Modules\Cart\Facades\Cart;

class ContractController extends Controller
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('account.dashboard.index');
    }

    public function contractUpdate($id) {
        $contract = Session::get("CurrentContract");
        $prevContractModel = Contract::whereId($contract)->first();
        $currentContractModel = Contract::whereId($id)->first();
        $cart = Cart::instance();
        if($contract != $id){
            Session::put("CurrentContract", $id);
            if ($prevContractModel->pricelist_id == $currentContractModel->pricelist_id || $cart->quantity() < 1) {
                return \response()->json(["None", $contract, trans('storefront::layout.price_confirm')]);
            } else {
                return \response()->json(["Ok", $contract, trans('storefront::layout.price_confirm')]);
            }
        }
    }
}
