<?php

namespace FleetCart;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Setting\Entities\Setting;

class Pricelist extends Model
{
    public function getPriceListId()
    {
        if (!Auth::check()) {
            return Setting::get('B2CPriceListID');
        } else {
            if (Auth::user()->company_id && Auth::user()->company_id > 0) {
                return Setting::get('B2BPriceListIDNowContract');
            }
        }
    }
}
