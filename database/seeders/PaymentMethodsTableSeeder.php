<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('payment_methods')->delete();

        \DB::table('payment_methods')->insert(array(
            0 =>
            array(
                'id' => 1,
                'name' => 'Cash',
                'slug' => 'cash',
                'details' => 'Cash On Delivery',
                'status' => 1,
                'created_at' => '2023-12-08 17:03:02',
                'updated_at' => '2023-12-08 17:03:02',
            ),
            1 =>
            array(
                'id' => 2,
                'name' => 'Bkash',
                'slug' => 'bkash',
                'details' => 'Popular Payment Geteway',
                'status' => 1,
                'created_at' => '2023-12-08 17:03:21',
                'updated_at' => '2023-12-08 17:07:39',
            ),
            2 =>
            array(
                'id' => 3,
                'name' => 'Rocket',
                'slug' => 'rocket',
                'details' => 'Popular Payment Geteway',
                'status' => 0,
                'created_at' => '2023-12-08 17:03:21',
                'updated_at' => '2023-12-08 17:07:39',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Nagad',
                'slug' => 'nagad',
                'details' => 'Popular Payment Geteway',
                'status' => 1,
                'created_at' => '2023-12-08 17:03:21',
                'updated_at' => '2023-12-08 17:07:39',
            ),
        ));
    }
}
