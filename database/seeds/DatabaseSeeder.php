<?php

use App\Product;
use App\Transaction;
use Illuminate\Database\Seeder;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $userQuantity = 200;
        $categoryQuantity = 30;
        $productQuantity = 1000;
        $transactionQuantity = 1000;

        // Creando 200 usuarios falsos en la base de datos
        factory(User::class, $userQuantity)->create();

        // Creando 30 categorias falsas en la base de datos
        factory(Category::class, $categoryQuantity)->create();
        // Creando
        factory(Product::class, $transactionQuantity)->create()->each(
            function ($product) {
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

                $product->categories()->attach($categories);
            }
        );

        // Creando 1000 transacciones falsas en la base de datos
        factory(Transaction::class, $transactionQuantity)->create();

    }
}
