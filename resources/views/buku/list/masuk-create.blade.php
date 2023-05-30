@extends('layouts.app')

@section('style')
@endsection

@section('breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $breadcumb ?? '' }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Beranda</li>
                        <li class="breadcrumb-item">/</li>
                        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ $breadcumb ?? '' }}</a>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Tambah Pengguna</h3>
                </div>
                <form action="{{ route('data-buku-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="name">Pilih Buku</label>
                                    <button type="button" class="form-control btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#PilihBuku">
                                        Pilih
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="buku">Buku</label>
                                    <input type="text" class="form-control @error('buku') is-invalid @enderror"
                                        id="buku" name="buku" value="{{ old('buku') }}" placeholder="Masukan Buku" readonly>
                                    <input type="hidden" id="id" name="id">
                                    @error('buku')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                        id="jumlah" name="jumlah" value="{{ old('jumlah') }}"
                                        placeholder="Masukan jumlah" required>
                                    @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                        <button type="submit" class="btn btn-success btn-footer">Tambah</button>
                        <a href="{{ route('data-buku-masuk') }}" class="btn btn-secondary btn-footer">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="PilihBuku" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <table id="userTable" class="table table-hover table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('img/cover/' . $item->cover) }}" alt="..."width="30px">
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td>@currency($item->harga)</td>
                                    <td>
                                        <button class="btn btn-danger"
                                            onclick="pilih('{{ $item->id }}','{{ $item->judul }}')">Pilih</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function pilih(id, judul) {
            $('#id').val(id);
            $('#buku').val(judul);
            $('#PilihBuku').modal('toggle');
        }
    </script>
@endsection
