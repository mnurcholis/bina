<!doctype html>
<html lang="en">

<head>

    @include('layouts.partials.head')
    <style>
        .bg-right {
            background-image: url('img/assets/login/login.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: #cccccc;
        }

        .bg-dark {
            position: absolute;
            height: 100%;
            width: 100%;
            right: 0;
            bottom: 0;
            left: 0;
            top: 0;
            opacity: .4;
            background-color: rgb(14, 1, 1)
        }

        @font-face {
            font-family: 'Tangerine';
            font-style: normal;
            font-weight: normal;
            src: local('Tangerine'), url('font/Cocon-Regular-Font.otf') format('truetype');
        }

        .font-telkom {
            font-family: 'Tangerine' !important;
        }

        p {
            color: #b3b3b3;
            font-weight: 300;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            font-family: "Roboto", sans-serif;
        }

        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        a:hover {
            text-decoration: none !important;
        }

        .content {
            padding: 7rem 0;
        }

        h2 {
            font-size: 20px;
        }

        .half,
        .half .container>.row {
            height: 100vh;
            min-height: 700px;
        }

        @media (max-width: 991.98px) {
            .half .bg {
                height: 200px;
            }

            .bg {
                display: none;
            }
        }

        .half .contents {
            background: #f6f7fc;
        }

        .half .contents,
        .half .bg {
            width: 50%;
        }

        @media (max-width: 1199.98px) {

            .half .contents,
            .half .bg {
                width: 100%;
            }

            .bg {
                display: none;
            }
        }

        .half .contents .form-control,
        .half .bg .form-control {
            border: none;
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            height: 54px;
            background: #fff;
        }

        .half .contents .form-control:active,
        .half .contents .form-control:focus,
        .half .bg .form-control:active,
        .half .bg .form-control:focus {
            outline: none;
            -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
        }

        .half .bg {
            background-size: cover;
            background-position: center;
        }

        .half a {
            color: #888;
            text-decoration: underline;
        }

        .half .btn {
            height: 54px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .half .forgot-pass {
            position: relative;
            top: 2px;
            font-size: 14px;
        }

        .control {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 14px;
        }

        .control .caption {
            position: relative;
            top: .2rem;
            color: #888;
        }

        .control input {
            position: absolute;
            z-index: -1;
            opacity: 0;
        }

        .control__indicator {
            position: absolute;
            top: 2px;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e6e6e6;
            border-radius: 4px;
        }

        .control--radio .control__indicator {
            border-radius: 50%;
        }

        .control:hover input~.control__indicator,
        .control input:focus~.control__indicator {
            background: #ccc;
        }

        .control input:checked~.control__indicator {
            background: #fb771a;
        }

        .control:hover input:not([disabled]):checked~.control__indicator,
        .control input:checked:focus~.control__indicator {
            background: #fb8633;
        }

        .control input:disabled~.control__indicator {
            background: #e6e6e6;
            opacity: 0.9;
            pointer-events: none;
        }

        .control__indicator:after {
            font-family: 'icomoon';
            content: '\e5ca';
            position: absolute;
            display: none;
            font-size: 16px;
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
        }

        .control input:checked~.control__indicator:after {
            display: block;
            color: #fff;
        }

        .control--checkbox .control__indicator:after {
            top: 50%;
            left: 50%;
            margin-top: -1px;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .control--checkbox input:disabled~.control__indicator:after {
            border-color: #7b7b7b;
        }

        .control--checkbox input:disabled:checked~.control__indicator {
            background-color: #7e0cf5;
            opacity: .2;
        }

        .bg-perpus {
            background: #000080;
        }
    </style>
    @include('layouts.partials.foot')

</head>

<body data-topbar="dark ">
    <div class="d-lg-flex half">
        <div class="bg order-1 bg-perpus order-md-2" style="background-image: url(''); "></div>
        <div class="contents">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-10">
                        <div class="mb-4 mb-md-5 text-center">
                            <a href="index.html" class="d-block auth-logo">
                                <img src="{{ asset('img/76-764671_software-tools-icon-png-transparent-png-removebg-preview.png') }}"
                                    alt="" height="80">
                            </a>
                            <div class="text-center">
                                <h5 class="mb-0 font-telkom">Selamat Datang</h5>
                                <p class="text-muted mt-2">Silahkan Daftar.</p>
                                <style>
                                body {
                                font-family: Arial, sans-serif;
                                }
                                
                                .login-link {
                                color: #337ab7;
                                text-decoration: none;
                                }
                                
                                .login-link:hover {
                                text-decoration: underline;
                                }
                                
                            </style>
                             <p>Sudah punya akun? silakan klik <a href="{{ url('login') }}">di sini</a> untuk menuju halaman login.</p>
                            </div>
                            <form class="mt-4 pt-2" method="POST" action="{{ route('register-store') }}">
                                @csrf
                                @include('components.form-message')

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="hidden" name="role" value="User">
                                            <input id="username" type="text"
                                                class="form-control  @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autofocus placeholder="Enter Name">
                                            <label for="input-username">Nama</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input id="username" type="text"
                                                class="form-control  @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}" required autofocus
                                                placeholder="Enter Name">
                                            <label for="input-username">Username</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input id="email" type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autofocus
                                                placeholder="Enter Name">
                                            <label for="input-username">Alamat Email</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input id="password" type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="password" value="{{ old('password') }}" required autofocus
                                                placeholder="Enter Name">
                                            <label for="input-username">Password</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input id="telepon" type="telepon"
                                                class="form-control  @error('telepon') is-invalid @enderror"
                                                name="telepon" value="{{ old('telepon') }}" required autofocus
                                                placeholder="Enter Name">
                                            <label for="input-username">Telepon</label>
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                            @error('telepon')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="text-muted mt-2">Alamat</p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::select('province', $get_prov, null, [
                                                'class' => 'form-control select-search',
                                                'placeholder' => 'Pilih Provinsi',
                                                'id' => 'provinsi',
                                            ]) }}
                                            <label for="input-username">Provinsi</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::select('district', [], null, [
                                                'class' => 'form-control select-search',
                                                'placeholder' => 'Pilih Kabupaten',
                                                'id' => 'kabupaten',
                                            ]) }}
                                            <label for="input-username">Kabupaten</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::select('subdistrict', [], null, [
                                                'class' => 'form-control select-search',
                                                'placeholder' => 'Pilih Kecamatan',
                                                'id' => 'kecamatan',
                                            ]) }}
                                            <label for="input-username">Kecamatan</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::select('area', [], null, [
                                                'class' => 'form-control select-search',
                                                'placeholder' => 'Pilih Kelurahan',
                                                'id' => 'kelurahan',
                                            ]) }}
                                            <label for="input-username">Kelurahan</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::select('post_code', [], null, [
                                                'class' => 'form-control select-search',
                                                'placeholder' => 'Pilih Kode Pos',
                                                'id' => 'kode_pos',
                                            ]) }}
                                            <label for="input-username">Kode Pos</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-floating form-floating-custom mb-4">
                                            {{ Form::textarea(null, old('alamat'), [
                                                'class' => 'form-control' . ($errors->has('alamat_tempat_praktik_mandiri') ? ' border-danger' : null),
                                                'placeholder' => 'Alamat Tempat Praktik Mandiri',
                                                'size' => '50x5',
                                                'id' => 'alamat',
                                                'name' => 'alamat',
                                            ]) }}
                                            <label for="input-username">Alamat Lengkap</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-6 text-center">
                                        <button class="btn btn-primary w-100 waves-effect waves-light font-telkom"
                                            type="submit">Kirim</button>
                                    </div> 
                                     -->
                                    <style>
                                .button {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    border-radius: 5px;
                                    font-size: 16px;
                                    color: #fff;
                                    text-decoration: none;
                                    transition: background-color 0.3s ease;
                                }
                            .button-primary {
                                background-color: #006eff;
                            }

                            .button-primary:hover {
                                background-color: #006eff;
                            }

                            .button-secondary {
                                background-color: #006eff;
                            }

                            .button-secondary:hover {
                                background-color: #008bff;
                            }
                            </style>
                            <button class="button button-primary"> Kirim</button>
                            <button onclick="goBack()" class="button button-secondary">Kembali</button>
                                    <script>
                                    function goBack() {
                                     window.history.back();
                                    }
                                    </script>
                                                        </div>
                                                            </div> 
                                                            
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        </div>
</body>

<script>
    $('#provinsi').change(function() {
        var kabupaten = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('kabupaten') }}?kabupaten=" + kabupaten,
            success: function(res) {
                // console.log(res);
                $("#kabupaten").empty();
                $("#kabupaten").append('<option value="">Pilih Kabupaten</option>');
                $.each(res, function(key, value) {
                    $("#kabupaten").append('<option value="' + value + '">' + value +
                        '</option>');
                });
                $("#kecamatan").empty();
                $("#kecamatan").append('<option value="">Pilih Kecamatan</option>');
                $("#kelurahan").empty();
                $("#kelurahan").append('<option value="">Pilih Kelurahan</option>');
                $("#kode_pos").empty();
                $("#kode_pos").append('<option value="">Pilih Kode Pos</option>');
            }
        });
    });

    $('#kabupaten').change(function() {
        var provinsi = $('#provinsi').val();
        var kabupaten = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('kecamatan') }}?provinsi=" + provinsi + "&kabupaten=" + kabupaten,
            success: function(res) {
                // console.log(res);
                $("#kecamatan").empty();
                $("#kecamatan").append('<option value="">Pilih Kecamatan</option>');
                $.each(res, function(key, value) {
                    $("#kecamatan").append('<option value="' + value + '">' + value +
                        '</option>');
                });
                $("#kelurahan").empty();
                $("#kelurahan").append('<option value="">Pilih Kelurahan</option>');
            }
        });
    });

    $('#kecamatan').change(function() {
        var provinsi = $('#provinsi').val();
        var kabupaten = $('#kabupaten').val();
        var kecamatan = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('kelurahan') }}?provinsi=" + provinsi + "&kabupaten=" + kabupaten +
                "&kecamatan=" + kecamatan ,
            success: function(res) {
                // console.log(res);
                $("#kelurahan").empty();
                $("#kelurahan").append('<option value="">Pilih Kelurahan</option>');
                $.each(res, function(key, value) {
                    $("#kelurahan").append('<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });
    $('#kelurahan').change(function() {
        var provinsi = $('#provinsi').val();
        var kabupaten = $('#kabupaten').val();
        var kecamatan = $('#kecamatan').val();
        var kelurahan = $(this).val();
        $.ajax({
            type: "GET",
            url: "{{ route('kode_pos') }}?provinsi=" + provinsi + "&kabupaten=" + kabupaten +
                "&kecamatan=" + kecamatan + "&kelurahan=" + kelurahan,
            success: function(res) {
                // console.log(res);
                $("#kode_pos").empty();
                $("#kode_pos").append('<option value="">Pilih Kode Pos</option>');
                $.each(res, function(key, value) {
                    $("#kode_pos").append('<option value="' + value + '">' + value +
                        '</option>');
                });
            }
        });
    });
</script>

</html>
