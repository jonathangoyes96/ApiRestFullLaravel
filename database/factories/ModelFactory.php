<?php

use App\Category;
use App\Product;
use App\Seller;
use App\Transaction;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => $verificado = $faker->randomElement([User::VERIFIED_USER, User::NOT_VERIFIED_USER]),
        'verification_token' => $verificado == User::VERIFIED_USER ? null : User::generateVerificationToken(),
        'admin' => $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
    ];
});

/*
 * Factory para catagories
 * name -> sera una palabra
 * description -> sera 1 parrafo
 */
$factory->define(Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

/*
 * Factory para products
 * name -> sera una palabra
 * description -> sera 1 parrafo
 * quantity -> sera un numero entre 1 y 10
 * status -> sera un aleatorio entre producto disponible y no disponible
 * image -> sera un aleatorio entre tres imagenes de la carpeta img en public
 * seller_id -> sera un random entre los id de los usuarios que ya existen en la base de datos
 */
$factory->define(Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1,10),
        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::NOT_AVAILABLE_PRODUCT]),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'seller_id' => User::all()->random()->id,
    ];
});


/*
 * Factory para Transactions
 * quantity -> sera un numero entre 1 y 4
 * buyer_id -> sera el id de un comprador que sea diferente al vendedor que se busco en la base de datos
 * product_id -> el id del producto debe ser diferente al id del vendedor ya que un vendedor no puede comprar sus mismos productos
 * 'product_id' => $seller->products->random() -> obteniendo un producto aleatorio de las lista de los productos que tiene un usuario vendedor
 */
$factory->define(Transaction::class, function (Faker\Generator $faker) {

    // Obteniendo un vendedor aleatorio para obtenerlo se busca si un usuario tiene productos en este caso seria un vendedor
    $seller = Seller::has('products')->get()->random();
    // Obteniendo un comprador de forma aleatoria diferente del vendedor
    $buyer = User::all()->except($seller->id)->random();

    return [
        'quantity' => $faker->numberBetween(1,3),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random(),
    ];
});