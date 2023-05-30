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
                    <h3 class="card-title text-white">Transaksi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Total</th>
                                    <th>Bayar</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($data)}} --}}
                                @foreach ($daftar as $item)
                                    <tr>
                                        <td>{{ $item->order_id }}</td>
                                        <td>@currency($item->total_bayar)</td>
                                        <td>@currency($item->gross_amount)</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email ?? '' }}</td>
                                        <td>
                                            @if ($item->transaction_status == 'settlement')
                                                Berhasil
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
