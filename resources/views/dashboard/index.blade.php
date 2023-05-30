@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/bootstrap-datepicker3.min.css') }}">
    <style>
        @use postcss-color-function;
        @use postcss-nested;
        @import url('https://fonts.googleapis.com/css?family=Raleway:400,700,900');

        <style>.master-data {
            cursor: pointer;
        }

        .master-data:hover {
            box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            -webkit-box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 0px 33px -14px rgba(0, 0, 0, 0.75);
            border-right: 4px solid rgb(0, 98, 128);
            ";

        }

        .info-box {
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            border-radius: 0.50rem;
            background-color: #fff;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 1rem;
            min-height: 80px;
            position: relative;
            width: 100%;
        }

        .info-box .info-box-icon {
            border-radius: 0.50rem 0 0 0.50rem;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            font-size: 1.875rem;
            -ms-flex-pack: center;
            justify-content: center;
            text-align: center;
            width: 70px;
        }

        .info-box .info-box-icon>img {
            max-width: 100%;
        }

        .info-box .info-box-content {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-pack: center;
            justify-content: center;
            line-height: 1.8;
            -ms-flex: 1;
            flex: 1;
            padding: 0 15px;
        }
    </style>
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
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.index') }}">{{ $breadcumb ?? '' }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 col-md-6">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12 p-1">
                    <div class="info-box bg-gradient-info master-data">
                        <span class="info-box-icon" style="background-color:#000080; "><i
                                class="fas fa-user text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text font-size-22 text-bold" style="color: black">Total Pengunjung</span>

                            <span class="font-size-18"
                                style="color: rgba(211, 125, 125, 0.788); line-height:normal;">Hari ini : <b>{{ $hari_ini }}</b></span>
                            <span class="font-size-18"
                                style="color: rgba(21, 191, 103, 0.788); line-height:normal;">Minggu ini : <b>{{ $tujuh_hari }}</b></span>
                            <span class="font-size-18"
                                style="color: rgba(138, 88, 213, 0.788); line-height:normal;">Bulan Ini : <b>{{ $bulan_ini }}</b></span>
                            <span class="font-size-18"
                                style="color: rgba(57, 236, 26, 0.788); line-height:normal;">Tahun Ini : <b>{{ $tahun_ini }}</b></span>
                            <span class="font-size-18"
                                style="color: rgba(158, 13, 13, 0.788); line-height:normal;">Semua : <b>{{ $semua }}</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
