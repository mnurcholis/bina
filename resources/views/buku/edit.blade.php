@extends('layouts.app')

@section('style')

@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Ubah Buku</h3>

            </div>
            <form action="{{ route('buku-update',$buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')

                <div class="card-body">

                
                    <div class="form-group mb-3">

                        <label for="name">Cover</label>
                        <img src="{{ asset('img/cover/'.$buku->cover) }}" class="card-img-top" alt="..." style="width:100px">
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ old('cover') ?? $buku->cover }}"  placeholder="Enter ">

                        @error('cover')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="form-group mb-3">

                        <label for="name">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') ?? $buku->judul }}"  placeholder="Enter ">

                        @error('judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">

                        <label for="name">Deskripsi</label>
                        <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"   placeholder="Enter "> {{ old('deskripsi') ?? $buku->deskripsi }} </textarea>

                        @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') ?? $buku->harga }}"  placeholder="Enter ">

                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Jenis</label>
                        <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                            <option value="Buku Rekomendasi" {{ $buku->jenis == 'Buku Rekomendasi' ? 'selected' : '' }}>Buku Rekomendasi</option>
                            <option value="Buku Seller" {{ $buku->jenis == 'Buku Seller' ? 'selected' : '' }}>Buku Seller</option>
                            <option value="Buku Promo" {{ $buku->jenis == 'Buku Promo' ? 'selected' : '' }}>Buku Promo</option>
                            <option value="Buku Terbaru" {{ $buku->jenis == 'Buku Terbaru' ? 'selected' : '' }}>Buku Terbaru</option>
                        </select>

                        @error('jenis')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">

                        <label for="name">Kategori</label>

                        <select class="form-control @error('id_kategori') is-invalid @enderror" name="id_kategori">
                        @foreach ($kategori as $bk)
                            <option value="{{ $bk->id }}" @if($bk->id == $buku->id_kategori) selected @endif>{{ $bk->kategori }}</option>
                        @endforeach
                        </select>

                        @error('id_kategori')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('script')

@endsection