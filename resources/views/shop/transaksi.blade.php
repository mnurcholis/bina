@extends('front-end.app')

@section('style-shop')
<style>
td, th {
    padding: 10px;
}
</style>
@endsection


@section('content-shop')
@include('sweetalert::alert')
	<section class="shop checkout section">
			<div class="container">
				<div class="row"> 
                <center>
                        <h4 style="color:black;margin:15px">Riwayat Transaksi Anda</h4>
                </center>
					<div class="col-lg-12 col-12">
						<table border="1">
                            <thead>
                            <tr>
                                <th style="text-align: center;">Judul Buku</th>
                                <th style="text-align: center;">Harga</th>
                                <th style="text-align: center;">Jumlah</th>
                                <th style="text-align: center;">Ongkos Kirim</th>
                                <th style="text-align: center;">Total</th>
                                <th style="text-align: center;">Status</th>
                            </tr>

                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->judul }}</td>
                                    <td>@currency($item->harga)</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>@currency($item->ongkir)</td>
                                    <td>@currency($item->total)</td>
                                    <td>
                                    @if ($item->status == 'Tunggu Bayar')
                                        <a href="{{ route('checkout-page',$item->id) }}" class="btn btn-success" style="background: orange;color: white;">Bayar</a>
                                        <a href="{{ route('cancel-checkout',$item->id) }}" class="btn btn-success" style="background: orange;color: white;">Batal</a>
                                    @else
                                    
                                        @if ($item->status == 'Dalam Perjalanan')
                                            {{ $item->status }} <br>
                                            <a href="{{ route('status-received',$item->id) }}" class="btn btn-success" style="background: green;color: white;">Konfirmasi Barang Sudah Diterima</a>
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
    </section>

@endsection

@section('script-shop')

@endsection