<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ComRegion;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function kabupaten(Request $request)
    {
        // $kabupaten = ComRegion::where("region_root", $request->kabupaten)->pluck('region_nm', 'region_cd');
        // $kabupaten = City::where('province_id',  $request->kabupaten)->get();
        $kabupaten = Region::select(DB::raw('district'))
            ->where('province', $request->kabupaten)
            ->groupBy('district')
            ->orderBy('district', 'asc')
            ->pluck('district', 'district');
        return response()->json($kabupaten);
    }

    public function kecamatan(Request $request)
    {
        $kecamatan = Region::select(DB::raw('subdistrict'))
            ->where('province', $request->provinsi)
            ->where('district', $request->kabupaten)
            ->groupBy('subdistrict')
            ->orderBy('subdistrict', 'asc')
            ->pluck('subdistrict', 'subdistrict');

        return response()->json($kecamatan);
    }

    public function kelurahan(Request $request)
    {
        $kelurahan = Region::select(DB::raw('area'))
            ->where('province', $request->provinsi)
            ->where('district', $request->kabupaten)
            ->where('subdistrict', $request->kecamatan)
            ->groupBy('area')
            ->orderBy('area', 'asc')
            ->pluck('area', 'area');
        return response()->json($kelurahan);
    }

    public function kode_pos(Request $request)
    {
        $kelurahan = Region::select(DB::raw('post_code'))
            ->where('province', $request->provinsi)
            ->where('district', $request->kabupaten)
            ->where('subdistrict', $request->kecamatan)
            ->where('area', $request->kelurahan)
            ->groupBy('post_code')
            ->orderBy('post_code', 'asc')
            ->pluck('post_code', 'post_code');

        return response()->json($kelurahan);
    }
}
