<?php

namespace Modules\Contract\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\Support\Eloquent\Model;
use Modules\User\Entities\User;
use Modules\Order\Entities\Order;

class Contract extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get a list of all contracts.
     *
     * @return array
     */
    public static function list()
    {
        return static::select(['id', 'name'])->get()->pluck('name', 'id');
    }

    /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_contracts', 'contract_id', 'user_id')->withTimestamps();
    }

    public function pricelist()
    {
        return $this->belongsTo('App\Pricelist')->withDefault();
    }

//    public function orders()
//    {
//        return $this->hasMany(Order::class);//->withTrashed();
//    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery());
    }

}
