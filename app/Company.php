<?php

namespace FleetCart;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function users()
    {
        return $this->hasMany('Modules\User\Entities\User');
    }
}
