<?php

namespace Modules\Contract;

use Auth;
use Modules\Contract\Entities\Contract as ContractDb;

class Contract
{
    /**
     * Array of all currencies.
     *
     * @var array
     */
    private static $contracts;

    /**
     * Get all currencies.
     *
     * @return array
     */
    public static function all($byUser = true)
    {
        if (is_null(self::$contracts)) {
            self::$contracts = [];
            if($byUser){
                $user = Auth::user();
                self::$contracts = $user->contracts()->get();
            }else{
                self::$contracts = ContractDb::all();
            }
        }

        return self::$contracts;
    }

}
