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
    @include('sweetalert::alert')

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Jarak Tanggal</h3>
                </div>
                <form action="{{ route('data-penjualan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_dari">Dari tanggal</label>
                                    <input type="date" class="form-control @error('name') is-invalid @enderror"
                                        id="tanggal_dari" name="tanggal_dari" value="{{ old('tanggal_dari') }}"
                                        placeholder="Enter Tanggal">
                                    @error('tanggal_dari')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_sampai">Sampai Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal_sampai') is-invalid @enderror"
                                        id="tanggal_sampai" name="tanggal_sampai" value="{{ old('tanggal_sampai') }}"
                                        placeholder="Enter Tanggal">
                                    @error('tanggal_sampai')
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
                        <button type="button" id="cari" class="btn btn-success btn-footer">Cari</button>
                    </div>
                </form>
            </div>

            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Data Penjualan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Ongkir</th>
                                    <th>Total</th>
                                    <th>Pembeli</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($data)}} --}}
                                {{-- @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>@currency($item->total)</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->tlp ?? '' }}</td>
                                        <td>{{ $item->email ?? '' }}</td>
                                        <td>{{ $item->alamat ?? '' }}</td>
                                        <td>
                                            {{ $item->status }}
                                        </td>
                                    </tr>
                                @endforeach --}}
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
        let token = $("meta[name='csrf-token']").attr("content");
        let alamat = "{{ url('') }}";
        // $('#example').dataTable();

        $("#cari").click(function() {
            var tanggal_dari = $('#tanggal_dari').val();
            var tanggal_sampai = $('#tanggal_sampai').val();
            if (tanggal_dari == '' || tanggal_sampai == '') {
                alert('Tanggal Tidak boleh kosong...');
            } else {
                jQuery.ajax({
                    url: alamat + "/cari_data_penjualan",
                    data: {
                        _token: token,
                        tanggal_dari: tanggal_dari,
                        tanggal_sampai: tanggal_sampai,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(respon) {
                        // console.log(respon);
                        $('#example > tbody').empty();
                        $.each(respon, function(key, value) {
                            $('#example > tbody').append('<tr><td>' + value.judul +
                                '</td><td> Rp. ' + value.harga + '</td><td>' + value.qty +
                                '</td><td> Rp. ' + value.ongkir + '</td><td> Rp. ' + value
                                .total + '</td><td>' + value.name + '</td><td>' + value
                                .tlp + '</td><td>' + value.email + '</td><td>' + value
                                .alamat + '</td><td>' + value.status + '</td>></tr>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
