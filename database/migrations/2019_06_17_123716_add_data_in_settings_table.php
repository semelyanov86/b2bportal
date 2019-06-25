<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddDataInSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
        // Insert some stuff
        DB::table('settings')->insert(
            array(
                'key' => 'B2CPriceListID',
                'is_translatable' => '0',
                'plain_value' => 's:1:"2";',
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'B2BPriceListIDNowContract',
                'is_translatable' => '0',
                'plain_value' => 's:1:"3";',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
