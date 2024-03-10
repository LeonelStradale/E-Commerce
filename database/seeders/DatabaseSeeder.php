<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');

        Storage::makeDirectory('products');
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create(
            [
                'name' => 'Edgar Leonel',
                'last_name' => 'Acevedo Cuevas',
                'email' => 'leonelstradale711@gmail.com',
                'phone' => '4922951793',
                'password' => bcrypt('Juni1200'),
            ]
        );

        \App\Models\User::factory()->create(
            [
                'name' => 'Edgar Leonel',
                'last_name' => 'Acevedo Cuevas',
                'email' => 'leonelasetto@gmail.com',
                'phone' => '4924920523',
                'password' => bcrypt('Juni1200'),
            ]
        );

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(150)->create();
    }
}
