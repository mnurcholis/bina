@extends('layouts.app')

@section('style')
@endsection

@section('breadcumb')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ $breadcumb ?? '' }}</h4>
                <!-- <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Beranda</li>
                        <li class="breadcrumb-item">/</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.index') }}">{{ $breadcumb ?? '' }}</a></li>
                    </ol>
                </div> -->
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">Beranda</li>
                        <li class="breadcrumb-item">/</li>
                        <li class="breadcrumb-item active"><a 
                                href="{{ route('users.index') }}">{{ $breadcumb ?? '' }}</a>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('sweetalert::alert')

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Tambah Kategori</h3>
                </div>

                <form action="{{ route('kategori-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="name">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                id="kategori" name="kategori" value="{{ old('kategori') }}" placeholder="Nama Kategori">

                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                        <button type="submit" class="btn btn-primary btn-footer">Simpan</button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-footer">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Data Kategori</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Kategori</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $item->id }}">
                                                    <i class="far fa-edit" style="color:green"></i>
                                                </button>
                                                <button type="button" class="" data-bs-toggle="modal"
                                                    data-bs-target="#modalhapus{{ $item->id }}">
                                                    <i class="far fa-trash-alt" style="color:red"></i>
                                                </button>
                                                </a>
                                            </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori
                                                                {{ $item->nama_kendaraan }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('kategori-update', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @include('components.form-message')

                                                                <div class="card-body">

                                                                    <div class="form-group mb-3">
                                                                        <label for="name">Kategori</label>
                                                                        <input type="text"
                                                                            class="form-control @error('kategori') is-invalid @enderror"
                                                                            id="kategori" name="kategori"
                                                                            value="{{ old('kategori') ?? $item->kategori }}"
                                                                            placeholder="Enter ">

                                                                        @error('kategori')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>

                                                                </div>

                                                                <!-- /.card-body -->

                                                                <div class="card-footer "
                                                                    style="border-radius:0px 0px 10px 10px;">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-footer">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <center>
                                                                <h5>Yakin Ingin Hapus data {{ $item->kategori }} ?</h5>
                                                                <br>
                                                                <a style="width:45%" class="btn btn-primary"
                                                                    href="{{ route('kategori-destroy', $item->id) }}">Hapus</a>
                                                                <br>
                                                                <br>
                                                                <button style="width:45%"type="button"
                                                                    class="btn btn-danger" data-bs-dismiss="modal">
                                                                    Batal</button>
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->kategori }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#example').dataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "language": {
                "sSearch": "Cari:",
                "sInfo": "Tampil _START_ ke _END_ dari _TOTAL_ data",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sLast": "Terkahir",
                    "sNext": "Lanjut",
                    "sPrevious": "Sebelumnya"
                },
                "sLengthMenu": "Tampil _MENU_ Data",
                "sZeroRecords": "Data tidak Ada..",
            },
        });
    </script>
@endsection
