<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([

                [
                    'companies_id' => '1',
                    'product_name' => '商品A',
                    'price' => '100',
                    'stock' => '1',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'

                ],
                [
                    'companies_id' => '2',
                    'product_name' => '商品B',
                    'price' => '100',
                    'stock' => '2',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '3',
                    'product_name' => '商品C',
                    'price' => '100',
                    'stock' => '3',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '4',
                    'product_name' => '商品D',
                    'price' => '100',
                    'stock' => '4',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'

                ],
                [
                    'companies_id' => '5',
                    'product_name' => '商品E',
                    'price' => '100',
                    'stock' => '5',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '6',
                    'product_name' => '商品F',
                    'price' => '100',
                    'stock' => '6',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '7',
                    'product_name' => '商品G',
                    'price' => '100',
                    'stock' => '7',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'

                ],
                [
                    'companies_id' => '8',
                    'product_name' => '商品H',
                    'price' => '100',
                    'stock' => '8',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '9',
                    'product_name' => '商品I',
                    'price' => '100',
                    'stock' => '9',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ],
                [
                    'companies_id' => '10',
                    'product_name' => '商品J',
                    'price' => '100',
                    'stock' => '10',
                    'comment' => 'テスト',
                    'img_path' => 'storage/img/11_MVC-1.jpg'
                ]
      ]);
     }
}
