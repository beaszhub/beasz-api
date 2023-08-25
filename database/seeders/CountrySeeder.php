<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use App\Enums\Status;
use App\Models\Currency;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = Currency::create([
            'name' =>  'Ringgit Malaysia',
            'code' => 'MYR',
            'symbol' => 'RM',
            'status' =>  Status::active,
        ]);

        $currency->country()->create([
            'name' => 'Malaysia',
            'iso2' => 'MY',
            'iso3' => 'MYS',
            'status' =>  Status::active,
        ]);
    }
}
