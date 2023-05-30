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
                                Data Buku Masuk
                            </span>
                        </div>

                        @can('user-create')
                            <div class="col-6 d-flex justify-content-end">
                                <a href="{{ route('data-buku.create') }}" class="btn btn-md btn-info">
                                    <i class="fa fa-plus"></i>
                                    Tambah Baru
                                </a>
                            </div>
                        @endcan

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
                                <th>Sampul</th>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                @if (auth()->user()->can('user-delete') ||
                                        auth()->user()->can('user-edit'))
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @if (!empty($item->Bukunya->cover))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if (!empty($item->Bukunya->cover))
                                                <img src="{{ asset('img/cover/' . $item->Bukunya->cover) }}"
                                                    alt="..."width="40px">
                                            @endif
                                        </td>
                                        <td>{{ $item->Bukunya->judul ?? '' }}</td>
                                        <td>
                                            @if (!empty($item->Bukunya->cover))
                                                @currency($item->Bukunya->harga)
                                            @endif
                                        </td>
                                        <td>{{ $item->jumlah }}</td>
                                        @if (auth()->user()->can('user-delete') ||
                                                auth()->user()->can('user-edit'))
                                            <td>
                                                <div class="btn-group">
                                                    @if (auth()->user()->can('user-delete'))
                                                        <a href="{{ route('hapus-data-buku-masuk', $item->id) }}"
                                                            class="btn btn-warning text-white">
                                                            <i class="far fa-trash-alt" style="color:white"></i>
                                                            Hapus
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
