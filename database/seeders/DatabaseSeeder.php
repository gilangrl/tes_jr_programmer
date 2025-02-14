<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\KategoriSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatusSeeder::class);
        $this->call(KategoriSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
