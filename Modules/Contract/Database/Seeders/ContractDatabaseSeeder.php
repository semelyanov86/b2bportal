<?php

namespace Modules\Contract\Database\Seeders;

use Illuminate\Database\Seeder;

class ContractDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::create(['name' => 'Contract #0000']);
    }
}
