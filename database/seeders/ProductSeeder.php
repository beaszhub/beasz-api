<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('name', 'Admin')->first();

        $store = $user->store;

        $currency = $store->user->country->currency;

        $products = [
            [
                'name' => 'Charge Per Hour',
                'description' => 'Rent',
                'type' => ProductType::virtual,
                'status' => Status::active,
            ],
            [
                'name' => 'Charge Per 6 Hour',
                'description' => 'Rent',
                'type' => ProductType::virtual,
                'status' => Status::active,
            ],
            [
                'name' => 'Durex Condom',
                'description' => 'Condom Classic Ultra Thin Anatomic Long Lasting',
                'type' => ProductType::physical,
                'status' => Status::active,
            ],
        ];

        $index = 0;

        foreach ($products as $product) {
            $newProduct = $store->products()->create($product);

            if ($index == 0) {
                $newProduct->prices()->create([
                    'product_id' => $newProduct->id,
                    'cost' => 3,
                    'unit' => 3,
                    'status' => Status::active,
                    'currency_id' => $currency->id,

                ]);
            } else if ($index == 1) {
                $newProduct->prices()->create([
                    'product_id' => $newProduct->id,
                    'cost' => 8,
                    'unit' => 8,
                    'status' => Status::active,
                    'currency_id' => $currency->id,

                ]);
            } else if ($index == 2) {
                $newProduct->prices()->create([
                    'product_id' => $newProduct->id,
                    'cost' => 3,
                    'unit' => 5,
                    'status' => Status::active,
                    'currency_id' => $currency->id,

                ]);
            }

            $index++;
        }
    }
}
