<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Status;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function importFromApi()
    {
        $username = 'tesprogrammer200125C02';
        $password = '15dc835ca1a9ee1c2b1e889bcb2882e0'; //bisacoding-20-01-25 saya menggunakan md5 generator
        // $password = md5('bisacoding-' . date('d') . '-' . date('m') . '-' . date('y'));    // INI FUNC MD5 DI LARAVEL

        // Kirim request ke API
        $response = Http::asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data'])) {
                foreach ($data['data'] as $item) {
                    // Simpan kategori jika belum ada
                    $kategori = Kategori::create(
                        ['nama_kategori' => $item['kategori']],
                    );

                    // Simpan status jika belum ada
                    $status = Status::create(
                        ['nama_status' => $item['status']]
                    );

                    Produk::create(
                        [
                            'nama_produk' => $item['nama_produk'],
                            'harga' => $item['harga'],
                            'kategori_id' => $kategori->id_kategori,
                            'status_id' => $status->id_status,
                        ]
                    );
                }

                return redirect()->back()->with('success', 'Data berhasil diimpor dan disimpan ke database!');
            } else {
                return redirect()->back()->with('error', 'Key "data" tidak ditemukan dalam respons API.');
            }
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data dari API. Status: ' . $response->status());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil produk yang memiliki status "bisa dijual"
        $kategori = Kategori::get();

        $produk = Produk::with(['kategori', 'status'])
            ->whereHas('status', function ($query) {
                $query->where('nama_status', 'bisa dijual');
            })
            ->get();

        return view('product.index', compact('produk', 'kategori'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $status = Status::all();
        return view('product.produk_add', compact('kategori', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'nama_kategori' => 'required|exists:kategori,id_kategori',
            'nama_status' => 'required|exists:status,id_status',
        ]);

        // Simpan data produk ke dalam database
        $data = Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'kategori_id' => $request->nama_kategori,
            'status_id' => $request->nama_status,
        ]);
        // dd($data);
        // Redirect dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data produk berdasarkan ID
        $produk = Produk::findOrFail($id);


        $kategori = Kategori::all();
        $status = Status::all();

        // Kembalikan data produk, kategori, dan status ke view edit
        return view('product.produk_update', compact('produk', 'kategori', 'status'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'nama_kategori' => 'required|exists:kategori,id_kategori',
            'nama_status' => 'required|exists:status,id_status',
        ]);

        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Update data produk
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'kategori_id' => $request->nama_kategori,
            'status_id' => $request->nama_status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $products = Produk::find($id);
            $products->delete();
            // dd($products);  
            $response = ['success' => 'Data Berhasil Dihapus!'];
        } catch (\Exception $e) {
            $response = ['errors' => $e];
        }

        return redirect()->route('produk.index')->with($response);
    }
}
