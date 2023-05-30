<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ListBukuController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Daftar Buku';
        $data['breadcumb'] = 'Buku';
        $data['kategori'] = Kategori::get();
        $data['buku'] = Buku::get();
        // dd($data['buku']);

        return view('buku.list.index', $data);
    }
}
