<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100000) as $index) {
            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $updatedAt = $faker->dateTimeBetween($createdAt, 'now');

            DB::table('contacts')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => $faker->email,
                'notes' => $faker->paragraph,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }
    }
}
