<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'L QUEENLY'],
            ['nama_kategori' => 'L MTH AKSESORIS (IM)'],
            ['nama_kategori' => 'L MTH TABUNG (LK)'],
            ['nama_kategori' => 'SP MTH SPAREPART (LK)'],
            ['nama_kategori' => 'CI MTH TINTA LAIN (IM)'],
            ['nama_kategori' => 'S MTH STEMPEL (IM)'],
        ]);
    }
}
