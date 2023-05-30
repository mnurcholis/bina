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
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                    <h3 class="card-title text-white">Tambah Pengguna</h3>
                </div>
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('components.form-message')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Masukkan Nama">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username') }}"
                                        placeholder="Masukan username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Masukan Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group mb-3">
                                    <label for="telepon">Telepon</label>
                                    <input type="telepon" class="form-control @error('telepon') is-invalid @enderror"
                                        id="telepon" name="telepon" value="{{ old('telepon') }}"
                                        placeholder="Masukan Telepon">
                                    @error('telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mb-3">
                                    <label> Peran</label>
                                    <select class="form-control" name="role">
                                        <option disabled selected>Pilih Peran</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ old('role') == $role ? 'selected' : '' }}>
                                                {{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="{{ old('password') }}"
                                        placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="approval" value="Approve">
                            </div>
                            <div class="col-3">
                                <div class="form-group mb-3">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                    </div>
                                    <div class="small text-danger">*Kosongkan jika tidak mau diisi</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating form-floating-custom mb-4">
                                    {{ Form::select('province', $get_prov, null, [
                                        'class' => 'form-control select-search',
                                        'placeholder' => 'Pilih Provinsi',
                                        'id' => 'provinsi',
                                    ]) }}
                                    <label for="input-username">Provinsi</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating form-floating-custom mb-4">
                                    {{ Form::select('district', [], null, [
                                        'class' => 'form-control select-search',
                                        'placeholder' => 'Pilih Kabupaten',
                                        'id' => 'kabupaten',
                                    ]) }}
                                    <label for="input-username">Kabupaten</label>
                                </div>
                            </div>
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
                        </div>
                        <div class="row">
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
                            <div class="col-4">
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
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                        <button type="submit" class="btn btn-success btn-footer">Tambah</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-footer">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
                    "&kecamatan=" + kecamatan,
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
@endsection
