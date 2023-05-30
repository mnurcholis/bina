<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
Use File;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Buku';
        $data['breadcumb'] = 'Buku';
        $data['kategori'] = Kategori::get();
        $data['buku'] = Buku::orderBy('id', 'desc')->get();
        // dd($data['buku']);

        return view('buku.multiple-index', $data);
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
            'judul'   => 'required',
            'harga'   => 'required',
            'deskripsi'   => 'required',
            'jenis'   => 'required',
            'id_kategori'   => 'required',
            'cover'   => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $jenis = new Buku();
        $jenis->judul = $validateData['judul'];
        $jenis->harga = $validateData['harga'];
        $jenis->deskripsi = $validateData['deskripsi'];
        $jenis->jenis= $validateData['jenis'];
        $jenis->id_kategori= $validateData['id_kategori'];

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/cover/');
            $image->move($destinationPath, $name);
            $jenis->cover = $name;
        }

        if ($request->hasFile('gambar1')) {
            $image = $request->file('gambar1');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/gambar1/');
            $image->move($destinationPath, $name);
            $jenis->gambar1 = $name;
        }

        if ($request->hasFile('gambar2')) {
            $image = $request->file('gambar2');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/gambar2/');
            $image->move($destinationPath, $name);
            $jenis->gambar2 = $name;
        }

        if ($request->hasFile('gambar3')) {
            $image = $request->file('gambar3');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/gambar3/');
            $image->move($destinationPath, $name);
            $jenis->gambar3 = $name;
        }

        $jenis->save();

        return redirect()->route('buku-list')->with(['success' => 'Berhasil!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Buku';
        $data['breadcumb'] = 'Buku';
        $data['kategori'] = Kategori::get();
        $data['buku'] = Buku::find($id);
        // dd($data['buku']);

        return view('buku.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'judul'   => 'required',
            'harga'   => 'required',
            'deskripsi'   => 'required',
            'jenis'   => 'required',
            'id_kategori'   => 'required',
        ]);

        $jenis = Buku::find($id);
        $jenis->judul = $validateData['judul'];
        $jenis->harga = $validateData['harga'];
        $jenis->deskripsi = $validateData['deskripsi'];
        $jenis->jenis= $validateData['jenis'];
        $jenis->id_kategori= $validateData['id_kategori'];

        if ($request->hasFile('cover')) {
            // Delete Img
            if ($jenis->cover) {
                $image_path = public_path('img/cover/'.$jenis->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            if ($request->hasFile('cover')) {
                $image = $request->file('cover');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/cover/');
                $image->move($destinationPath, $name);
                $jenis->cover = $name;
            }
        }
        if ($request->hasFile('gambar1')) {
            // Delete Img
            if ($jenis->gambar1) {
                $image_path = public_path('img/gambar1/'.$jenis->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            if ($request->hasFile('gambar1')) {
                $image = $request->file('gambar1');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/gambar1/');
                $image->move($destinationPath, $name);
                $jenis->gambar1 = $name;
            }
        }
        if ($request->hasFile('gambar2')) {
            // Delete Img
            if ($jenis->gambar2) {
                $image_path = public_path('img/gambar2/'.$jenis->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            if ($request->hasFile('gambar2')) {
                $image = $request->file('gambar2');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/gambar2/');
                $image->move($destinationPath, $name);
                $jenis->gambar2 = $name;
            }
        }
        if ($request->hasFile('gambar3')) {
            // Delete Img
            if ($jenis->gambar3) {
                $image_path = public_path('img/gambar3/'.$jenis->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            if ($request->hasFile('gambar3')) {
                $image = $request->file('gambar3');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/gambar3/');
                $image->move($destinationPath, $name);
                $jenis->gambar3 = $name;
            }
        }


        $jenis->save();

        return redirect()->route('buku-list')->with(['success' => 'Berhasil!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Buku::find($id);
        $jenis->delete();

        return redirect()->route('buku-list')->with(['success' => 'Berhasil!']);

    }
}
