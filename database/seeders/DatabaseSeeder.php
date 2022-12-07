<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $arrUser = [];

        for ($i = 0; $i<30; $i++ ) {
            $arrUser[] = [
                "name" => "Hai".($i + 1),
                'email'=> ($i + 1)."@gmail.com",
                'password'=> Hash::make('123456'),
                'avatar'=>"",
                'phone'=>123456789,
                'address'=>'Trịnh Văn Bô'.($i+1),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('users')->insert(
            $arrUser
        );


        $arrProduct = [];

        for ($i = 0; $i<30; $i++ ) {
            $arrProduct[] = [
                "name" => "Sản phẩm".($i + 1),
                "image"=> "",
                "price"=> 100,
                "quantity"=> 100,
                "view" => "Đẹp",
                "discount" => $i,
                "desc"=> "sản phầm đẹp".($i+1),
                "cate_id" => $i,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('product')->insert(
            $arrProduct
        );

        $arrCategory = [];

        for ($i = 0; $i<30; $i++ ) {
            $arrCategory[] = [
                "name" => "Danh mục".($i + 1),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('categories')->insert(
            $arrCategory
        );


        $arrRole = [];

        for ($i = 0; $i<5; $i++ ) {
            $arrRole[] = [
                "name" => "Admin".($i + 1),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('role')->insert(
            $arrRole
        );
    }
}
