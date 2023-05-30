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
                    <h3 class="card-title text-white">Status Pemesanan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Jumlah</th>
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
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>@currency($item->total)</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->tlp ?? '' }}</td>
                                        <td>{{ $item->email ?? '' }}</td>
                                        <td>{{ $item->alamat ?? '' }}</td>
                                        <td>
                                            @if ($item->status == 'Tunggu Bayar')
                                                Tunggu Pembayaran
                                                <br>
                                                <a href="{{ route('cancel-checkout', $item->id) }}" class="btn btn-success"
                                                    style="background: orange;color: white;">Batal</a>
                                            @else
                                                @if ($item->status == 'Sudah Dibayar')
                                                    <a href="{{ route('status-on-delivery', $item->id) }}"
                                                        class="btn btn-success"
                                                        style="background: orange;color: white;">Dalam Pengiriman</a>
                                                @elseif($item->status == 'konfirmasi-cancel')
                                                    <a href="{{ route('cancel-checkout', $item->id) }}"
                                                        class="btn btn-success"
                                                        style="background: orange;color: white;">Konfimasi batal</a>
                                                @else
                                                    {{ $item->status }}
                                                @endif
                                            @endif
                                        </td>
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
                "sEmptyTable": "Kosong...",
                "sInfoEmpty": "Tampil 0 ke 0 dari 0 data",
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
