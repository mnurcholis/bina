<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\JenisKendaraan;
use App\Models\ParkirKeluar;
use App\Models\ParkirMasuk;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => 'dashboard']);
    }

    public function dashboard(Request $request)
    {
        $data['page_title'] = 'Dasbor';
        $data['breadcumb'] = 'Dasbor';

        $start_day = Carbon::now()->subDays(7);
        $end_day = Carbon::now();

        $data['hari_ini'] = Counter::whereDate('created_at', Carbon::today())->get()->count();
        $data['tujuh_hari'] = Counter::whereBetween('created_at', [$start_day, $end_day])->get()->count();
        $data['bulan_ini'] = Counter::whereMonth('created_at', Carbon::now()->month)->get()->count();
        $data['tahun_ini'] = Counter::whereYear('created_at', Carbon::now()->year)->get()->count();
        $data['semua'] = Counter::get()->count();

        // $tanggal_sampai = Carbon::createFromFormat('Y-m-d', date("Y-m-d"));
        // $hari = DB::table('checkouts')
        //     ->join('bukus', 'bukus.id', '=', 'checkouts.id_buku')
        //     ->join('users', 'users.id', '=', 'checkouts.id_user')
        //     ->select('SUM( checkouts.qty ) as qty, SUM( checkouts.total - checkouts.ongkir ) as ongkir')
        //     ->whereDate(DB::raw('DATE(checkouts.created_at)'), $tanggal_sampai)
        //     ->get();
        // $hari_qty = '';
        // $hari_harga = '';
        // $hari_total = '';
        // foreach ($hari as $row) {
        //     $hari_qty = (int) $hari_qty + $row->qty;
        //     if (!isset($row->ongkir)) {
        //         $ongkir = $row->ongkir;
        //     } else {
        //         $ongkir = 0;
        //     }
        //     $hari_total = (int) $hari_total  + ((int) $row->total - (int) $ongkir);
        // }

        // $data['hari'] = array(
        //     'qty' => $hari_qty,
        //     'total' => $hari_total
        // );

        // dd($hari);

        return view('dashboard.index', $data);
    }
}
