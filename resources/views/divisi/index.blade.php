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
                    <li class="breadcrumb-item"><a href="{{ route('master-data.index') }}">Data Master</a></li>
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
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              <i class="far fa-user text-lg"></i> 
              Daftar Divisi
            </span>
          </div>

          <div class="col-6 d-flex justify-content-end">
            <a href="{{ route('divisi-create') }}" class="btn btn-md btn-info">
              <i class="fa fa-plus"></i> 
              Tambah Baru
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Divisi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($divisi as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_divisi }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ route('divisi-edit', $item->id) }}" class="btn btn-warning text-white">
                      <i class="far fa-edit"></i>
                      Ubah
                    </a>
                    <a href="{{ route('divisi-destroy', $item->id) }}" class="btn btn-danger f-12">
                      <i class="far fa-trash-alt"></i>
                      Hapus
                    </a>
                  </div>
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
$('#example').dataTable();
</script>
@endsection