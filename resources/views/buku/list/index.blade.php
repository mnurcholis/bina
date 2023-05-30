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
                        <li class="breadcrumb-item active"><a href="{{ route('data-buku-list') }}">{{ $breadcumb ?? '' }}</a>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <div class="row">
                        <div class="col-6 mt-1">
                            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
                                <i class="far fa-user text-lg"></i>
                                Daftar Buku
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            @include('sweetalert::alert')
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="userTable" class="table table-hover table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                @if (auth()->user()->can('user-delete') ||
                                        auth()->user()->can('user-edit'))
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('img/cover/' . $item->cover) }}" alt="..."width="40px">
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td>@currency($item->harga)</td>
                                    <td>{{ $item->stok }}</td>
                                    @if (auth()->user()->can('user-delete') ||
                                            auth()->user()->can('user-edit'))
                                        <td>
                                            <div class="btn-group">
                                                @can('user-edit')
                                                    <a href="{{ route('buku-edit', $item->id) }}"
                                                        class="btn btn-warning text-white">
                                                        <i class="far fa-edit"></i>
                                                        Ubah
                                                    </a>
                                                @endcan
                                                @if (auth()->user()->can('user-delete'))
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#modalhapus{{ $item->id }}">
                                                        <i class="far fa-trash-alt" style="color:white"></i>
                                                        Hapus
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @foreach ($buku as $item)
            <div class="modal fade" id="modalhapus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <center>
                                <h5>Yakin Ingin Hapus data {{ $item->judul }} ?</h5>
                                <br>
                                <a style="width:45%" class="btn btn-primary"
                                    href="{{ route('buku-destroy', $item->id) }}">Hapus</a>
                                <br>
                                <br>
                                <button style="width:45%"type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    Batal</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
@endsection
