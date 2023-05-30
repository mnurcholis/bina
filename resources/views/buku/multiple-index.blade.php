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
                    <li class="breadcrumb-item">beranda</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
@include('sweetalert::alert')

<div class="modal fade" id="modalcreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buku-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')
    
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="name">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}"  placeholder="Judul Buku ">

                            @error('judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Deskripsi</label>
                            <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"  placeholder="Enter "> </textarea>

                            @error('deskripsi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}"  placeholder="Enter ">

                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Jenis</label>
                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                <option value="Buku Rekomendasi">Rekomendasi</option>
                                <option value="Best Promo">Promo</option>
                                <option value="Buku Terbaru">Terbaru</option>
                                <option value="Buku Terlaris">Terlaris</option>
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
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                            </select>

                            @error('id_kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Cover</label>
                            <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ old('cover') }}"  placeholder="Enter ">

                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                
                    <!-- /.card-body -->
    
                    <div class="card-footer " style="border-radius:0px 0px 10px 10px;">
                        <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Data Buku</h3>
                   <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modalcreate">
                         Tambah
                    </button>
            </div>
            <div class="row">
                @foreach ($buku as $item)
                 
                            
                    <div class="col-sm-3">
                        <div class="card shadow-lg mt-5">
                        <img src="{{ asset('img/cover/'.$item->cover) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <h5 class="card-title">@currency($item->harga)</h5>
                            <p class="card-text">{{ $item->deskripsi }}.</p>
                            <a href="{{ route('buku-edit',$item->id) }}" class="btn btn-primary">
                            <i class="far fa-edit" style="color:white"></i>
                                Ubah
                            </a>
                            </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalhapus{{ $item->id }}">
                                <i class="far fa-trash-alt" style="color:white"></i>
                                Hapus
                            </button>
                        </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Buku {{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('buku-update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @include('components.form-message')
                    
                                    <div class="card-body">
                    
                                        <div class="form-group mb-3">
                                            <label for="name">Judul</label>
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') ?? $item->judul }}"  placeholder="Enter ">

                                            @error('judul')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">Deskripsi</label>
                                            <textarea type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"   placeholder="Enter "> {{ old('deskripsi') ?? $item->deskripsi }} </textarea>

                                            @error('deskripsi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">Harga</label>
                                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') ?? $item->harga }}"  placeholder="Enter ">

                                            @error('harga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">Jenis</label>
                                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                                <option value="Buku Rekomendasi" {{ $item->jenis == 'Buku Rekomendasi' ? 'selected' : '' }}>Buku Rekomendasi</option>
                                                <option value="Buku Seller" {{ $item->jenis == 'Buku Seller' ? 'selected' : '' }}>Buku Seller</option>
                                                <option value="Buku Promo" {{ $item->jenis == 'Buku Promo' ? 'selected' : '' }}>Buku Promo</option>
                                                <option value="Buku Terbaru" {{ $item->jenis == 'Buku Terbaru' ? 'selected' : '' }}>Buku Terbaru</option>
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
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                            @endforeach
                                            </select>

                                            @error('id_kategori')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="name">Cover {{ $item->cover }}</label>
                                            <img src="{{ asset('img/cover/'.($item->cover ?? 'user.png')) }}" width="110px" class="image img" />
                                            <input type="file" class="form-control @error('cover') is-invalid @enderror" id="cover" name="cover" value="{{ old('cover') ?? $item->cover }}"  placeholder="Enter ">

                                            @error('cover')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                     
                                    
                                    </div>
                                    
                                    <!-- /.card-body -->
                    
                                    <div class="card-footer " style="border-radius:0px 0px 10px 10px;">
                                        <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                   
                            
                @endforeach
            </div>

             @foreach ($buku as $item)
                 <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <center>
                                    <h5>Yakin Ingin Hapus data {{ $item->judul }} ?</h5>
                                    <br>
                                    <a style="width:45%" class="btn btn-primary" href="{{ route('buku-destroy',$item->id) }}">Hapus</a>
                                    <br>
                                    <br>
                                    <button  style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal"> Batal</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#example').dataTable();
</script>
@endsection