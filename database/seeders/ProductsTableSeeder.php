<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Summer Hoover',
                'slug' => 'summer-hoover',
                'sku' => 'Nam dolorem accusamu',
                'category_id' => 1,
                'brand_id' => 1,
                'unit_id' => 3,
                'supplier_id' => 4,
                'purchase_price' => '0.00',
                'selling_price' => '419.00',
                'unit_quantity_in_stock' => 0,
                'subunit_quantity_in_stock' => 0,
                'alert_quantity' => 820,
                'manufacturing_date' => NULL,
                'expiry_date' => NULL,
                'status' => 1,
                'tags' => NULL,
                'description' => 'Necessitatibus dolor',
                'created_by' => NULL,
                'image' => NULL,
                'created_at' => '2023-12-08 19:17:25',
                'updated_at' => '2023-12-08 19:17:25',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Conan Sloan',
                'slug' => 'conan-sloan',
                'sku' => 'Id tempora laudantiu',
                'category_id' => 3,
                'brand_id' => 3,
                'unit_id' => 1,
                'supplier_id' => 2,
                'purchase_price' => '0.00',
                'selling_price' => '12.00',
                'unit_quantity_stock' => 0,
                'subunit_quantity_stock' => 0,
                'alert_quantity' => 114,
                'manufacturing_date' => NULL,
                'expiry_date' => NULL,
                'status' => 1,
                'tags' => NULL,
                'description' => 'Qui numquam temporib',
                'created_by' => NULL,
                'image' => NULL,
                'created_at' => '2023-12-08 19:17:31',
                'updated_at' => '2023-12-08 19:17:31',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Math Notebook',
                'slug' => 'math-notebook',
                'sku' => 'Consectetur aut rer',
                'category_id' => 3,
                'brand_id' => 2,
                'unit_id' => 7,
                'supplier_id' => 4,
                'purchase_price' => '0.00',
                'selling_price' => '875.00',
                'unit_quantity_stock' => 0,
                'subunit_quantity_stock' => 0,
                'alert_quantity' => 470,
                'manufacturing_date' => NULL,
                'expiry_date' => NULL,
                'status' => 1,
                'tags' => NULL,
                'description' => 'Irure hic ullam mole',
                'created_by' => NULL,
                'image' => NULL,
                'created_at' => '2023-12-08 19:18:01',
                'updated_at' => '2023-12-08 19:18:01',
            ),
        ));
        
        
    }
}