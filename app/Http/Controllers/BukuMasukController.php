<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DataBukuMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuMasukController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Daftar Buku Masuk';
        $data['breadcumb'] = 'Buku Masuk';
        $data['data'] = DataBukuMasuk::get();

        return view('buku.list.masuk', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Tambah Data Buku Masuk';
        $data['breadcumb'] = 'Tambah Data Buku Masuk';
        $data['buku'] = Buku::all();

        return view('buku.list.masuk-create', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id'   => 'required',
            'buku'   => 'required',
            'jumlah'   => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $buku = Buku::findOrFail($request->id);
            $buku->stok = $buku->stok + $request->jumlah;
            $buku->save();

            DataBukuMasuk::create([
                'buku_id' => $request->id,
                'jumlah' => $request->jumlah,
            ]);
        });

        return redirect()->route('data-buku-masuk')->with(['success' => 'Berhasil!']);
    }

    public function hapus(Request $request, $id)
    {
        $data = DataBukuMasuk::find($id);
        DB::transaction(function () use ($data) {
            $buku = Buku::findOrFail($data->buku_id);
            $buku->stok = $buku->stok - $data->jumlah;
            $buku->save();

            DataBukuMasuk::find($data->id)->delete();
        });

        return redirect()->route('data-buku-masuk')->with(['success' => 'Berhasil!']);
    }
}
