<?php

namespace App\Console\Commands;

use App\Models\Produk;
use App\Models\Status;
use App\Models\Kategori;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FetchProduk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:produk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data produk dari API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = 'tesprogrammer190125C04';
        $password = 'bisacoding-' . now()->format('d-m-y');
        $password_md5 = md5($password); // Encode MD5
        // dd($password_md5); // Dinamis sesuai tanggal

        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';
        // Pastikan tidak ada spasi atau karakter tersembunyi
        $username = trim($username);
        $password_md5 = trim($password_md5);
        $data = [
            'username' => $username,
            'password' => $password_md5,
        ];
        // dd($data);

        // Cek bahwa URL dan header sudah sesuai
        $response = Http::asForm()->post($url, $data);

        if ($response->successful()) {
            $data = $response->json(); // Mendapatkan data JSON

            foreach ($data as $item) {
                if (is_array($item)) {
                    // Pastikan kategori dan status ada
                    if (isset($item['kategori']) && isset($item['status'])) {
                        // Menyimpan kategori jika belum ada
                        $kategori = Kategori::firstOrCreate(['nama_kategori' => $item['kategori']]);

                        // Menyimpan status jika belum ada
                        $status = Status::firstOrCreate(['nama_status' => $item['status']]);

                        // Menyimpan produk
                        $produk = Produk::updateOrCreate(
                            ['id_produk' => $item['id_produk']], // Mencari berdasarkan id_produk
                            [
                                'nama_produk' => $item['nama_produk'],
                                'harga' => $item['harga'],
                                'kategori_id' => $kategori->id_kategori, // Menggunakan id kategori
                                'status_id' => $status->id_status, // Menggunakan id status
                            ]
                        );

                        // Log informasi tentang produk yang disimpan
                        Log::info('Produk disimpan atau diperbarui:', ['id_produk' => $produk->id_produk, 'nama_produk' => $produk->nama_produk]);
                    } else {
                        Log::warning('Kategori atau status tidak ditemukan pada item:', $item);
                    }
                }
            }
        } else {
            $this->error('Gagal mengambil data dari API. Status code: ' . $response->status());
            $this->error('Response body: ' . $response->body());
        }
    }
}
