<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Kategori';
        $data['breadcumb'] = 'Kategori';
        $data['kategori'] = Kategori::get();

        return view('kategori.multiple-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori'   => 'required|string|min:3',
        ]);

        $jenis = new Kategori();
        $jenis->kategori = $validateData['kategori'];
        $jenis->save();

        return redirect()->route('kategori-list')->with(['success' => 'Berhasil!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'kategori'   => 'required|string|min:3',
        ]);

        $jenis = Kategori::find($id);
        $jenis->kategori = $validateData['kategori'];
        $jenis->save();

        return redirect()->route('kategori-list')->with(['success' => 'Berhasil  !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori, $id)
    {
        $jenis = Kategori::find($id);
        $jenis->delete();

        return redirect()->route('kategori-list')->with(['success' => 'Berhasil  !']);
    }
}
