<?php

namespace FleetCart;

use Illuminate\Database\Eloquent\Model;

class ProductCount extends Model
{
    public function storage()
    {
        return $this->belongsTo('FleetCart\Storage');
    }
}
