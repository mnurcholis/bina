<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Checkout;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailContact;
use App\Models\Bayaran;
use App\Models\City;
use App\Models\Counter;
use App\Models\Province;
use App\Models\User;
use Carbon\Carbon;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $geoipInfo = geoip()->getLocation($_SERVER['REMOTE_ADDR']);

        $hitung = [
            'ip' => $geoipInfo->ip,
            'iso_code' => $geoipInfo->iso_code,
            'country' => $geoipInfo->country,
            'city' => $geoipInfo->city,
            'state' => $geoipInfo->state,
            'state_name' => $geoipInfo->state_name,
            'postal_code' => $geoipInfo->postal_code,
            'lat' => $geoipInfo->lat,
            'lon' => $geoipInfo->lon,
            'timezone' => $geoipInfo->timezone,
            'continent' => $geoipInfo->continent,
            'currency' => $geoipInfo->currency,
        ];

        $posts = Counter::where('ip', $geoipInfo->ip)->whereDate('created_at', Carbon::today())->get();
        if ($posts->count() == 0) {
            Counter::create($hitung);
        }

        $data['page_title'] = 'Bina';
        $data['breadcumb'] = 'Beranda';
        $data['kategori'] = Kategori::get();

        $kat = $request->kategori;
        $search = $request->search;

        if ($kat == null) {
            $kat = 'all';
        }

        $data['bukuRekomendasi'] = Buku::where('jenis', 'Buku Rekomendasi')->where(function ($query) use ($kat, $search) {
            if ($kat != 'all') {
                $query->where('id_kategori', $kat);
            }
            if ($search != null) {
                $query->where('judul', 'like', "%" . $search . "%");
            }
        })->get();
        $data['bukuBestSeller'] = Buku::where('jenis', 'Best Seller')->where(function ($query) use ($kat, $search) {
            if ($kat != 'all') {
                $query->where('id_kategori', $kat);
            }
            if ($search != null) {
                $query->where('judul', 'like', "%" . $search . "%");
            }
        })->get();
        $data['bukuPromo'] = Buku::where('jenis', 'Buku Promo')->where(function ($query) use ($kat, $search) {
            if ($kat != 'all') {
                $query->where('id_kategori', $kat);
            }
            if ($search != null) {
                $query->where('judul', 'like', "%" . $search . "%");
            }
        })->get();
        $data['bukuTerbaru'] = Buku::where('jenis', 'Buku Terbaru')->where(function ($query) use ($kat, $search) {
            if ($kat != 'all') {
                $query->where('id_kategori', $kat);
            }
            if ($search != null) {
                $query->where('judul', 'like', "%" . $search . "%");
            }
        })->get();

        if ($search != null) {


            $bukuRekomendasi = count($data['bukuRekomendasi']);
            $bukuBestSeller = count($data['bukuBestSeller']);
            $bukuPromo = count($data['bukuPromo']);
            $bukuTerbaru = count($data['bukuTerbaru']);
            $list = [];

            array_push($list, $bukuRekomendasi, $bukuBestSeller, $bukuPromo, $bukuTerbaru);

            $hasilbanyak = max($list);
            // dd($hasilbanyak);
            if ($hasilbanyak == $bukuRekomendasi) {
                $data['banyakRekomendasi'] = true;
                $data['banyakbukuBestSeller'] = false;
                $data['banyakbukuPromo'] = false;
                $data['banyakbukuTerbaru'] = false;
            }
            if ($hasilbanyak == $bukuBestSeller) {
                $data['banyakRekomendasi'] = false;
                $data['banyakbukuBestSeller'] = true;
                $data['banyakbukuPromo'] = false;
                $data['banyakbukuTerbaru'] = false;
            }
            if ($hasilbanyak == $bukuPromo) {
                $data['banyakRekomendasi'] = false;
                $data['banyakbukuBestSeller'] = false;
                $data['banyakbukuPromo'] = true;
                $data['banyakbukuTerbaru'] = false;
            }
            if ($hasilbanyak == $bukuTerbaru) {
                $data['banyakRekomendasi'] = false;
                $data['banyakbukuBestSeller'] = false;
                $data['banyakbukuPromo'] = false;
                $data['banyakbukuTerbaru'] = true;
            }
        } else {
            $data['banyakRekomendasi'] = true;
            $data['banyakbukuBestSeller'] = false;
            $data['banyakbukuPromo'] = false;
            $data['banyakbukuTerbaru'] = false;
        }

        // dd($data);

        return view('shop.home', $data);
    }

    public function checkout(Request $request)
    {

        $data = new Checkout();
        $data->id_buku = $request->id_buku;
        $cek = Buku::find($request->id_buku)->harga;
        $data->status = 'Tunggu Bayar';
        $data->qty = $request->qty;
        $data->total = $cek * $request->qty;
        $data->id_user = Auth::user()->id;
        $data->alamat = '';
        $data->save();

        return redirect()->route('checkout-page', $data->id)->with(['success' => 'Berhasil! Silahkan isi kelengkapan data untuk melanjutkan pembayaran']);
    }

    public function checkoutPage(Request $request, $id)
    {
        $data['checkout'] = Checkout::find($id);
        $cek_bayar = Bayaran::where('checkout_id', $id)->where('gross_amount', null)->get();
        if (count($cek_bayar) > 0) {
            $data['cek_bayar'] = Bayaran::where('checkout_id', $id)->where('gross_amount', null)->firstOrFail();
        }
        $data['provinces'] = Province::pluck('name', 'province_id');

        return view('shop.checkout', $data);
    }

    public function cancel_checkout(Request $request, $id)
    {
        if (Auth::user()->getRoleNames()[0] == 'user') {
            Checkout::find($id)->update(['status' => 'Konfirmasi-batal']);
            return redirect()->route('transaksi')->with(['success' => 'Berhasil! Silahkan lihat dimenu transaksi untuk melihat perkembangan paketmu']);
        } else {
            Checkout::find($id)->update(['status' => 'Batal']);
            return redirect()->route('transaksi-list')->with(['success' => 'Berhasil!']);
        }
    }

    public function update_checkout(Request $request)
    {

        $id = $request->checkout;
        $data = Checkout::find($id);
        $data->status = 'Tunggu Bayar';
        $data->alamat = Auth::user()->Alamat->Lokasi->province . ', ' . Auth::user()->Alamat->Lokasi->district
            . ', ' . Auth::user()->Alamat->Lokasi->subdistrict
            . ', ' . Auth::user()->Alamat->Lokasi->area
            . ', ' . Auth::user()->Alamat->alamat
            . ', ' . Auth::user()->Alamat->Lokasi->post_code;
        $data->ongkir = $request->ongkirnya;
        $data->tlp = (int) Auth::user()->telepon;
        $data->postal_code = Auth::user()->Alamat->Lokasi->post_code;
        $buku = Buku::find($data->id_buku);
        $data->total = ($buku->harga * $data->qty) + $request->ongkirnya;
        $data->save();

        $cek_bayar = Bayaran::where('checkout_id', $id)->where('gross_amount', null)->get();

        // Set your Merchant Server Key
        // \Midtrans\Config::$serverKey = 'SB-Mid-server-JJjwCE50BO9SrYsHrZn4KrLW';
        \Midtrans\Config::$serverKey = 'Mid-server-rfXghlsJpp8pKIR2Ms4Uq9MR';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = false;

        if (count($cek_bayar) == 0) {

            $order_id = date('Ymd') . rand();

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $request->totalnya,
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => (int) Auth::user()->telepon
                ),
            );

            $acuan = \Midtrans\Snap::getSnapToken($params);

            Bayaran::create([
                'checkout_id' => $id,
                'order_id' => $order_id,
                'snaptoken' => $acuan,
                'total_bayar' => $request->totalnya,
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => (int) Auth::user()->telepon
            ]);
        } else {
            $okedah = Bayaran::where('checkout_id', $id)->where('total_bayar', $request->totalnya)->where('gross_amount', null)->get();
            if (count($okedah) == 0) {
                $oke_bayar = Bayaran::where('checkout_id', $id)->where('gross_amount', null)->firstOrFail();

                $params = array(
                    'transaction_details' => array(
                        'order_id' => $oke_bayar->order_id,
                        'gross_amount' => $request->totalnya,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'last_name' => '',
                        'email' => Auth::user()->email,
                        'phone' => (int) Auth::user()->telepon
                    ),
                );

                $acuan = \Midtrans\Snap::getSnapToken($params);

                $oke_bayar->total_bayar = $request->totalnya;
                $oke_bayar->snaptoken = $acuan;
                $oke_bayar->save();
            } else {
                $bayar = Bayaran::where('checkout_id', $id)->where('gross_amount', null)->firstOrFail();
                $acuan = $bayar->snaptoken;
            }
        }

        $oke = array(
            'params' => $acuan,
            'data' => $data
        );

        return response()->json($oke);
    }

    public function update_bayaran(Request $request)
    {
        if ($request->fraud_status == "accept") {
            $bayar = Bayaran::where('order_id', $request->order_id)->first();
            $bayar->transaction_status = $request->transaction_status;
            $bayar->status_code = $request->status_code;
            $bayar->gross_amount = $request->gross_amount;
            $bayar->save();

            $checkout = Checkout::find($bayar->checkout_id);
            $checkout->bayar = $request->gross_amount;
            if ($request->gross_amount == $checkout->total) {
                $checkout->status = 'Sudah Dibayar';
            }
            $checkout->save();

            $buku = Buku::findOrFail($checkout->id_buku);
            $buku->stok = $buku->stok - $checkout->qty;
            $buku->save();
        }
        // return response()->json('oke');
        return redirect()->route('home')->with(['success' => 'Berhasil! Silahkan lihat dimenu transaksi untuk melihat perkembangan paketmu']);
    }

    public function setPaid(Request $request)
    {

        if ($request->fraud_status == "accept") {
            $bayar = Bayaran::where('order_id', $request->order_id)->first();
            $bayar->transaction_status = $request->transaction_status;
            $bayar->status_code = $request->status_code;
            $bayar->gross_amount = $request->gross_amount;
            $bayar->save();

            $checkout = Checkout::find($bayar->checkout_id);
            $checkout->bayar = $request->gross_amount;
            if ($request->gross_amount == $checkout->total) {
                $checkout->status = 'Sudah Dibayar';
            }
            $checkout->save();

            $buku = Buku::findOrFail($checkout->id_buku);
            $buku->stok = $buku->stok - $checkout->qty;
            $buku->save();
        }

        return redirect()->route('home')->with(['success' => 'Berhasil! Silahkan lihat dimenu transaksi untuk melihat perkembangan paketmu']);
    }

    public function transaksi()
    {

        $data['data'] = DB::table('checkouts')
            ->join('bukus', 'bukus.id', '=', 'checkouts.id_buku')
            ->select('checkouts.*', 'bukus.judul as judul', 'bukus.harga')
            ->where('id_user', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('shop.transaksi', $data);
    }
    public function transaksilist()
    {

        $data['data'] = DB::table('checkouts')
            ->join('bukus', 'bukus.id', '=', 'checkouts.id_buku')
            ->join('users', 'users.id', '=', 'checkouts.id_user')
            ->select('checkouts.*', 'bukus.judul as judul', 'users.name as name', 'users.email as email')
            ->orderBy('id', 'desc')
            ->get();
        // dd($data);
        return view('pesanan.index', $data);
    }

    public function data_penjualan(Request $request)
    {
        $data['data'] = DB::table('checkouts')
            ->join('bukus', 'bukus.id', '=', 'checkouts.id_buku')
            ->join('users', 'users.id', '=', 'checkouts.id_user')
            ->select('checkouts.*', 'bukus.judul as judul', 'users.name as name', 'users.email as email')
            ->get();
        return view('data_penjualan.index', $data);
    }

    public function daftar_pembayaran()
    {
        $data['daftar'] = Bayaran::whereNotNull('gross_amount')->get();

        return view('pesanan.daftar_pembayaran', $data);
    }

    public function cari_data_penjualan(Request $request)
    {
        $tanggal_dari = Carbon::createFromFormat('Y-m-d', $request->tanggal_dari);
        $tanggal_sampai = Carbon::createFromFormat('Y-m-d', $request->tanggal_sampai);
        $oke = DB::table('checkouts')
            ->join('bukus', 'bukus.id', '=', 'checkouts.id_buku')
            ->join('users', 'users.id', '=', 'checkouts.id_user')
            ->select('checkouts.*', 'bukus.judul as judul', 'bukus.harga as harga', 'users.name as name', 'users.email as email')
            ->whereDate(DB::raw('DATE(checkouts.created_at)'), '>=', $tanggal_dari)
            ->whereDate(DB::raw('DATE(checkouts.created_at)'), '<=', $tanggal_sampai)
            ->get();
        return response()->json($oke);
    }

    public function setOnDelivery($id)
    {
        $data = Checkout::find($id);
        $data->status = 'Dalam Perjalanan';
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil!']);
    }
    public function setReceived($id)
    {
        $data = Checkout::find($id);
        $data->status = 'Pesanan Diterima';
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil!']);
    }
    public function contact()
    {
        return view('shop.contact');
    }
    public function sendMail(Request $request)
    {

        $data = [
            'name' => $request->name,
            'subject' => $request->subject,
            'msg' => $request->message,
            'email' => $request->email,
            'phone' => $request->company_name,
        ];
        Mail::to('sarjanisahmanurung22@gmail.com')->send(new MailContact($data));

        return redirect()->route('contact')->with(['success' => 'Pesan telah terkirim!']);
    }
}