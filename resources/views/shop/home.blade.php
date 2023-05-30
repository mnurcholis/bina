@extends('front-end.app')

@section('style-shop')
@endsection


@section('content-shop')
    @include('sweetalert::alert')
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Daftar Buku</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-info">
                        <form method="get" action="">
                            @csrf
                            <input type="hidden" value="{{ Request::get('search') }}" name="kategori">

                            <select name="kategori" onchange="this.form.submit()">
                                <option value="all">Semua Kategori</option>
                                @php
                                    $kategori = \app\Models\Kategori::get();
                                @endphp
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ Request::get('kategori') == $item->id ? 'selected' : '' }}>{{ $item->kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        
                        <div class="nav-main">
                            <!-- Tab Nav -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link @if ($banyakRekomendasi) active @endif"
                                        data-toggle="tab" href="#Rekomendasi" role="tab">Rekomendasi</a></li>
                                <li class="nav-item"><a class="nav-link @if ($banyakbukuPromo) active @endif"
                                        data-toggle="tab" href="#Promo" role="tab">Promo</a></li>
                                <li class="nav-item"><a class="nav-link @if ($banyakbukuTerbaru) active @endif"
                                        data-toggle="tab" href="#Terbaru" role="tab">Terbaru</a></li>
                                <li class="nav-item"><a class="nav-link @if ($banyakbukuBestSeller) active @endif"
                                        data-toggle="tab" href="#Seller" role="tab">Terlaris</a></li>
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">

                            <!-- Start Single Tab -->
                            <div class="tab-pane fade  @if ($banyakbukuBestSeller) show active @endif" id="Seller"
                                role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($bukuBestSeller as $item)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product"
                                                    style="border-radius: 2%;border: 1px solid rgb(152, 147, 147);padding: 10px;">
                                                    <div class="product-img">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModalSeller{{ $item->id }}">
                                                            <img class="default-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                            <img class="hover-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="#" data-toggle="modal"
                                                                data-target="#exampleModalSeller{{ $item->id }}">{{ substr($item->judul, 0, 28) }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            <span>@currency($item->harga)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="exampleModalSeller{{ $item->id }}"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span class="ti-close"
                                                                    aria-hidden="true"></span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row no-gutters">
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <!-- Product Slider -->
                                                                    <div class="product-gallery text-center">
                                                                        <img src="{{ asset('img/gambar3/' . $item->cover) }}"
                                                                            alt="#">
                                                                    </div>
                                                                    <!-- End Product slider -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="quickview-content">
                                                                        @php
                                                                            $kategori = \app\Models\Kategori::where('id', $item->id_kategori)->first()->kategori;
                                                                        @endphp
                                                                        <h2>{{ $item->judul }}</h2>
                                                                        <div class="quickview-ratting-review">
                                                                        </div>
                                                                        <h3>@currency($item->harga)</h3>
                                                                        <div class="quickview-peragraph">
                                                                            <p class="mb-3"><b>Kategori :
                                                                                    {{ $kategori }}</b></p>
                                                                            <p>{!! nl2br(e($item->deskripsi)) !!}</p>

                                                                            <br>
                                                                            <p>Stok : <b>{{ $item->stok }}</b> Buah</p>
                                                                            <hr>
                                                                        </div>
                                                                        <div class="quantity">
                                                                            @if (Auth::check())
                                                                                <form action="{{ route('checkout') }}"
                                                                                    method="post"
                                                                                    id="pesan_sekarang-{{ $item->id }}">
                                                                                    @csrf
                                                                            @endif
                                                                            <!-- Input Order -->
                                                                            <div class="input-group">
                                                                                <div class="button minus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="minus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="qty-{{ $item->id }}"
                                                                                    id="qty-{{ $item->id }}"
                                                                                    class="input-number" data-min="1"
                                                                                    data-max="{{ $item->stok }}"
                                                                                    value="1">
                                                                                <input type="hidden" name="qty"
                                                                                    id="qtya{{ $item->id }}" class="input-number"
                                                                                    data-min="1" data-max="1000"
                                                                                    value="1">
                                                                                <input type="hidden" name="id_buku"
                                                                                    value="{{ $item->id }}">
                                                                                <div class="button plus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="plus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <!--/ End Input Order -->
                                                                        </div><br>
                                                                        <div class="add-to-cart">
                                                                            @if (Auth::check())
                                                                                <button type="button"
                                                                                    onclick="$('#qtya{{ $item->id }}').val($('#qty-{{ $item->id }}').val()); $('#pesan_sekarang-{{ $item->id }}').submit();"
                                                                                    class="btn btn-primary">Belanja</button>
                                                                                </form>
                                                                            @else
                                                                                <a style="color: #280e9b"
                                                                                    href="{{ route('user.login') }}">Silahkan
                                                                                    Masuk / Daftar Untuk Berbelanja</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade @if ($banyakbukuPromo) show active @endif" id="Promo"
                                role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($bukuPromo as $item)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product"
                                                    style="border-radius: 20px;border: 1px solid rgb(152, 147, 147);padding: 10px;">
                                                    <div class="product-img">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModalPromo{{ $item->id }}">
                                                            <img class="default-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                            <img class="hover-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="#" data-toggle="modal"
                                                                data-target="#exampleModalPromo{{ $item->id }}">{{ substr($item->judul, 0, 28) }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            <span>@currency($item->harga)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="exampleModalPromo{{ $item->id }}"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span class="ti-close"
                                                                    aria-hidden="true"></span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row no-gutters">
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <!-- Product Slider -->
                                                                    <div class="product-gallery text-center">
                                                                        <img src="{{ asset('img/gambar3/' . $item->cover) }}"
                                                                            alt="#">
                                                                    </div>
                                                                    <!-- End Product slider -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="quickview-content">
                                                                        @php
                                                                            $kategori = \app\Models\Kategori::where('id', $item->id_kategori)->first()->kategori;
                                                                        @endphp
                                                                        <h2>{{ $item->judul }}</h2>
                                                                        <div class="quickview-ratting-review">
                                                                        </div>
                                                                        <h3>@currency($item->harga)</h3>
                                                                        <div class="quickview-peragraph">
                                                                            <p class="mb-3"><b>Kategori :
                                                                                    {{ $kategori }}</b></p>
                                                                            <p>{!! nl2br(e($item->deskripsi)) !!}</p>
                                                                            <br>
                                                                            <p>Stok : <b>{{ $item->stok }}</b> Buah</p>
                                                                            <hr>
                                                                        </div>
                                                                        <div class="quantity">
                                                                            @if (Auth::check())
                                                                                <form action="{{ route('checkout') }}"
                                                                                    method="post"
                                                                                    id="pesan_sekarang-{{ $item->id }}">
                                                                                    @csrf
                                                                            @endif
                                                                            <!-- Input Order -->
                                                                            <div class="input-group">
                                                                                <div class="button minus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="minus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="qty-{{ $item->id }}"
                                                                                    id="qty-{{ $item->id }}"
                                                                                    class="input-number" data-min="1"
                                                                                    data-max="{{ $item->stok }}"
                                                                                    value="1">
                                                                                <input type="hidden" name="qty"
                                                                                    id="qtya{{ $item->id }}" class="input-number"
                                                                                    data-min="1" data-max="1000"
                                                                                    value="1">
                                                                                <input type="hidden" name="id_buku"
                                                                                    value="{{ $item->id }}">
                                                                                <div class="button plus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="plus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <!--/ End Input Order -->
                                                                        </div><br>
                                                                        <div class="add-to-cart">
                                                                            @if (Auth::check())
                                                                                <button type="button"
                                                                                    onclick="$('#qtya{{ $item->id }}').val($('#qty-{{ $item->id }}').val()); $('#pesan_sekarang-{{ $item->id }}').submit();"
                                                                                    class="btn btn-primary">Belanja</button>
                                                                                </form>
                                                                            @else
                                                                                <a style="color: #280e9b"
                                                                                    href="{{ route('user.login') }}">Silahkan
                                                                                    Masuk / Daftar Untuk Berbelanja</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade @if ($banyakRekomendasi) show active @endif"
                                id="Rekomendasi" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($bukuRekomendasi as $item)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product"
                                                    style="border-radius: 20px;border: 1px solid rgb(152, 147, 147);padding: 10px;">
                                                    <div class="product-img">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModal{{ $item->id }}">
                                                            <img class="rounded"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                            <img class="hover-img rounded"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="#" data-toggle="modal"
                                                                data-target="#exampleModal{{ $item->id }}">{{ substr($item->judul, 0, 28) }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            <span>@currency($item->harga)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span class="ti-close"
                                                                    aria-hidden="true"></span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row no-gutters">
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <!-- Product Slider -->
                                                                    <div class="product-gallery text-center">
                                                                        <img src="{{ asset('img/gambar3/' . $item->cover) }}"
                                                                            alt="#">
                                                                    </div>
                                                                    <!-- End Product slider -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="quickview-content">
                                                                        @php
                                                                            $kategori = \app\Models\Kategori::where('id', $item->id_kategori)->first()->kategori;
                                                                        @endphp
                                                                        <h2>{{ $item->judul }}</h2>
                                                                        <div class="quickview-ratting-review">
                                                                        </div>
                                                                        <h3>@currency($item->harga)</h3>
                                                                        <div class="quickview-peragraph">
                                                                            <p class="mb-3"><b>Kategori :
                                                                                    {{ $kategori }}</b></p>
                                                                            <p>{!! nl2br(e($item->deskripsi)) !!}</p>
                                                                            <br>
                                                                            <p>Stok : <b>{{ $item->stok }}</b> Buah</p>
                                                                            <hr>
                                                                        </div>
                                                                        <div class="quantity">
                                                                            @if (Auth::check())
                                                                                <form action="{{ route('checkout') }}"
                                                                                    method="post"
                                                                                    id="pesan_sekarang-{{ $item->id }}">
                                                                                    @csrf
                                                                            @endif
                                                                            <!-- Input Order -->
                                                                            <div class="input-group">
                                                                                <div class="button minus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="minus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="qty-{{ $item->id }}"
                                                                                    id="qty-{{ $item->id }}"
                                                                                    class="input-number" data-min="1"
                                                                                    data-max="{{ $item->stok }}"
                                                                                    value="1">
                                                                                <input type="hidden" name="qty"
                                                                                    id="qtya{{ $item->id }}" class="input-number"
                                                                                    data-min="1" data-max="1000"
                                                                                    value="1">
                                                                                <input type="hidden" name="id_buku"
                                                                                    value="{{ $item->id }}">
                                                                                <div class="button plus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="plus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <!--/ End Input Order -->
                                                                        </div><br>
                                                                        <div class="add-to-cart">
                                                                            @if (Auth::check())
                                                                                <button type="button"
                                                                                    onclick="$('#qtya{{ $item->id }}').val($('#qty-{{ $item->id }}').val()); $('#pesan_sekarang-{{ $item->id }}').submit();"
                                                                                    class="btn btn-primary">Belanja</button>
                                                                                </form>
                                                                            @else
                                                                                <a style="color: #280e9b"
                                                                                    href="{{ route('user.login') }}">Silahkan
                                                                                    Masuk / Daftar Untuk Berbelanja</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                            <!-- Start Single Tab -->
                            <div class="tab-pane fade @if ($banyakbukuTerbaru) show active @endif"
                                id="Terbaru" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @foreach ($bukuTerbaru as $item)
                                            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                                <div class="single-product"
                                                    style="border-radius: 20px;border: 1px solid rgb(152, 147, 147);padding: 10px;">
                                                    <div class="product-img">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#exampleModalTerbaru{{ $item->id }}">
                                                            <img class="default-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                            <img class="hover-img"
                                                                src="{{ asset('img/cover/' . $item->cover) }}"
                                                                alt="#">
                                                        </a>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3><a href="#" data-toggle="modal"
                                                                data-target="#exampleModalTerbaru{{ $item->id }}">{{ substr($item->judul, 0, 28) }}</a>
                                                        </h3>
                                                        <div class="product-price">
                                                            <span>@currency($item->harga)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="exampleModalTerbaru{{ $item->id }}"
                                                tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span class="ti-close"
                                                                    aria-hidden="true"></span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row no-gutters">
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <!-- Product Slider -->
                                                                    <div class="product-gallery text-center">
                                                                        <img src="{{ asset('img/gambar3/' . $item->cover) }}"
                                                                            alt="#">
                                                                    </div>
                                                                    <!-- End Product slider -->
                                                                </div>
                                                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="quickview-content">
                                                                        @php
                                                                            $kategori = \app\Models\Kategori::where('id', $item->id_kategori)->first()->kategori;
                                                                        @endphp
                                                                        <h2>{{ $item->judul }}</h2>
                                                                        <div class="quickview-ratting-review">
                                                                        </div>
                                                                        <h3>@currency($item->harga)</h3>
                                                                        <div class="quickview-peragraph">
                                                                            <p class="mb-3"><b>Kategori :
                                                                                    {{ $kategori }}</b></p>
                                                                            <p>{!! nl2br(e($item->deskripsi)) !!}</p>
                                                                            <br>
                                                                            <p>Stok : <b>{{ $item->stok }}</b> Buah</p>
                                                                            <hr>
                                                                        </div>
                                                                        <div class="quantity">
                                                                            @if (Auth::check())
                                                                                <form action="{{ route('checkout') }}"
                                                                                    method="post"
                                                                                    id="pesan_sekarang-{{ $item->id }}">
                                                                                    @csrf
                                                                            @endif
                                                                            <!-- Input Order -->
                                                                            <div class="input-group">
                                                                                <div class="button minus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="minus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                                <input type="text"
                                                                                    name="qty-{{ $item->id }}"
                                                                                    id="qty-{{ $item->id }}"
                                                                                    class="input-number" data-min="1"
                                                                                    data-max="{{ $item->stok }}"
                                                                                    value="1">
                                                                                <input type="hidden" name="qty"
                                                                                    id="qtya{{ $item->id }}" class="input-number"
                                                                                    data-min="1" data-max="1000"
                                                                                    value="1">
                                                                                <input type="hidden" name="id_buku"
                                                                                    value="{{ $item->id }}">
                                                                                <div class="button plus">
                                                                                    <button type="button"
                                                                                        class="btn btn-primary btn-number"
                                                                                        data-type="plus"
                                                                                        data-field="qty-{{ $item->id }}">
                                                                                        <i class="ti-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <!--/ End Input Order -->
                                                                        </div><br>
                                                                        <div class="add-to-cart">
                                                                            @if (Auth::check())
                                                                                <button type="button"
                                                                                    onclick="$('#qtya{{ $item->id }}').val($('#qty-{{ $item->id }}').val()); $('#pesan_sekarang-{{ $item->id }}').submit();"
                                                                                    class="btn btn-primary">Belanja</button>
                                                                                </form>
                                                                            @else
                                                                                <a style="color: #280e9b"
                                                                                    href="{{ route('user.login') }}">Silahkan
                                                                                    Masuk / Daftar Untuk Berbelanja</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-shop')
    <script>
        function coba(oke) {
            $('#qty').val(oke);
        }
    </script>
@endsection
