@extends('front-end.app')

@section('style-shop')
@endsection


@section('content-shop')
    @include('sweetalert::alert')
    <section class="shop checkout section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="checkout-form">
                        <h2>Lakukan Pembayaran Anda Disini</h2>
                        {{-- <p>Silakan mendaftar untuk checkout lebih cepat</p> --}}
                        <!-- Form -->
                        <form class="form" method="post" action="{{ route('status-paid') }}" id="set-paid">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nama lengkap<span>*</span></label>
                                        <input type="hidden" name="id_checkout" value="{{ $checkout->id }}" placeholder=""
                                            required="required">
                                        <input type="hidden" id="order_id" name="order_id" placeholder=""
                                            required="required">
                                        <input type="hidden" id="transaction_status" name="transaction_status"
                                            placeholder="" required="required">
                                        <input type="hidden" id="status_code" name="status_code" placeholder=""
                                            required="required">
                                        <input type="hidden" id="fraud_status" name="fraud_status" placeholder=""
                                            required="required">
                                        <input type="hidden" id="gross_amount" name="gross_amount" placeholder=""
                                            required="required">
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder=""
                                            required="required" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Alamat email<span>*</span></label>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                                            placeholder="" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Alamat<span>*</span></label>
                                        <textarea rows="5" readonly>
@if (Auth::user()->Alamat)
{{ Auth::user()->Alamat->Lokasi->province ?? '' }}, {{ Auth::user()->Alamat->Lokasi->district ?? '' }}, {{ Auth::user()->Alamat->Lokasi->subdistrict ?? '' }}, {{ Auth::user()->Alamat->Lokasi->area ?? '' }}, {{ Auth::user()->Alamat->alamat ?? '' }}, Kode Pos : {{ Auth::user()->Alamat->Lokasi->post_code ?? '' }}
@endif | No Telepon : {{ Auth::user()->telepon }}
</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Pilih Kurir <span>*</span></label>
                                        <select class="form-control kurir" name="courier" id="courier">
                                            <option value="0">-- pilih kurir --</option>
                                            <option value="jne">JNE</option>
                                            <option value="pos">POS</option>
                                            <option value="tiki">TIKI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <div id="coba">
                                            <ul class="list-group" id="ongkir"></ul>
                                        </div>
                                        <div id="loading">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="order-details">
                        <!-- Order Widget -->
                        <div class="single-widget">
                            <h2>TOTAL KERANJANG</h2>
                            <div class="content">
                                <ul>
                                    <li>Harga Buku : <span>@currency(($checkout->total - $checkout->ongkir) / $checkout->qty)</span></li>
                                    <li>(+) Kuantitas<span>{{ $checkout->qty }}</span></li>
                                    <li>(+) Ongkir<span id="ongkirnya">@currency($checkout->ongkir)</span><input type="hidden"
                                            value="{{ $checkout->ongkir }}" id="ongkirku"></li>
                                    <li class="last">Total<span id="totalnya">@currency($checkout->total)</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget get-button">
                            <div class="content">
                                <div class="button">
                                    <a href="#" class="btn" id="pay-button">lanjutkan ke pembayaran</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script-shop')
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-2918MpL3HwGWXTii"></script>
    {{-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-rXpcDyiKCLQRreUP"></script> --}}
    <script type="text/javascript">
        let alamat = "{{ url('') }}";
        //ajax select kota tujuan
        let isProcessing = false;
        let city_destination, province_destination, totalnya = "{{ $cek_bayar->snaptoken ?? '' }}";
        let token = $("meta[name='csrf-token']").attr("content");
        console.log(token);
        $('#courier').on('change', function(e) {
            e.preventDefault();

            let city_origin = 278;
            province_destination = $('select[name=province_destination]').val();
            city_destination = {{ Auth::user()->Alamat->Lokasi->city_ro ?? '278' }};
            // console.log(city_destination);
            let courier = $('select[name=courier]').val();
            let weight = {{ $checkout->qty }} * 20;

            if (isProcessing) {
                return;
            }

            isProcessing = true;
            jQuery.ajax({
                url: alamat + "/ongkir",
                data: {
                    _token: token,
                    city_origin: city_origin,
                    city_destination: city_destination,
                    courier: courier,
                    weight: weight,
                },
                dataType: "JSON",
                type: "POST",
                beforeSend: function() {
                    /* Show image container */
                    $('#loading').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                    );
                },
                success: function(holla) {
                    isProcessing = false;
                    if (holla) {
                        // console.log(holla);
                        $('#loading').html('');
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(holla[0]['costs'], function(key,
                            value) {
                            $('#ongkir').append(
                                '<li class="list-group-item">' +
                                holla[0].code
                                .toUpperCase() +
                                ' ' + value.cost[0]
                                .etd +
                                ' <button class="btn btn primary btn-xs" type="button" onclick="myFunction(' +
                                value.cost[0].value +
                                ')"> Pilih </button></li>'
                            )
                        });

                    }
                }
            });
        });

        function myFunction(dana) {
            jQuery.ajax({
                url: alamat + "/update_checkout",
                data: {
                    _token: token,
                    checkout: {{ $checkout->id }},
                    ongkirnya: dana,
                    totalnya: (dana + {{ $checkout->total - $checkout->ongkir }}),
                    province_destination: province_destination,
                    city_destination: city_destination,
                },
                dataType: "JSON",
                type: "POST",
                success: function(respon) {
                    $('#ongkirnya').html('Rp. ' + respon.data.ongkir);
                    $('#ongkirku').val(respon.data.ongkir);
                    $('#totalnya').html('Rp. ' + respon.data.total);
                    // console.log(respon);
                    totalnya = respon.params;
                }
            });
        }

        let ongkir = $('#ongkirku').val();

        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {

            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay(totalnya, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    $('#order_id').val(result.order_id);
                    $('#transaction_status').val(result.transaction_status);
                    $('#status_code').val(result.status_code);
                    $('#fraud_status').val(result.fraud_status);
                    $('#gross_amount').val(result.gross_amount);
                    $('#set-paid').submit();
                    // alert("payment success!");
                    // console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("Menunggu pembayaranmu!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert("Kamu menutup jendela web tanpa menyelesaikan pembayaran");
                }
            })
        });
    </script>
@endsection