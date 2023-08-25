<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        switch (config('app.env')) 
        {
            case 'production': {
                $this->productionSeeder();
                break;
            }
            default: {
                $this->developmentSeeder();
                break;
            }
        }
    }

    public function productionSeeder() 
    {   
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
    }

    public function developmentSeeder() 
    {
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
