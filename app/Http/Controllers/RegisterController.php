<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use App\Models\ComRegion;
use App\Models\User;
use App\Models\HistoryLog;
use App\Models\Province;
use App\Models\Region;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Daftar';
        $data['breadcumb'] = 'Master App';
        $data['roles'] = Role::pluck('name')->all();

        // $data['get_prov'] = Province::pluck('name', 'province_id')->all();
        // $data['get_prov'] = ComRegion::where("region_level", 1)->pluck('region_nm', 'region_nm');
        $data['get_prov'] = Region::select(DB::raw('province'))
            ->groupBy('province')
            ->orderBy('province', 'asc')
            ->pluck('province','province');

        return view('auth.register', $data);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|unique:users,username|alpha_dash',
            'email'   => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'telepon' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
            'province' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'area' => 'required',
            'post_code' => 'required',
            'alamat' => 'required',
        ]);

        $cek = Region::where('province', $validateData['province'])
            ->where('district', $validateData['district'])
            ->where('subdistrict', $validateData['subdistrict'])
            ->where('area', $validateData['area'])
            ->where('post_code', $validateData['post_code'])
            ->first();

        $user = new User();
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->email = $validateData['email'];
        $user->telepon = $validateData['telepon'];
        $user->password = Hash::make($validateData['password']);
        $user->approval = 'Pending';

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();

        AlamatUser::create([
            'user_id' => $user->id,
            'region_id' => $cek->region_id,
            'alamat' => $validateData['alamat'],
        ]);

        $user->assignRole($validateData['role']);

        return redirect()->route('user.login')->with(['success' => 'Pendaftaran Berhasil!']);
    }
}
