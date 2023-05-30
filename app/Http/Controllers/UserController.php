<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use App\Models\Province;
use App\Models\Region;
use App\Models\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
    }

    public function loginPost2(Request $request)
    {
        $val = $request->nip;
        $password = $request->password;

        $cekMail = User::where('username', $val)->first();


        if ($cekMail != null) {
            // request untuk login menggunakan nim

            // if ($cekMail->approval == 'Pending') {
            //     return redirect()->back()->with(['success' => 'Akunmu belum disetujui']);
            // }elseif ($cekMail->approval == 'Not Approve') {
            //     return redirect()->back()->with(['success' => 'Akunmu tidak disetujui']);
            // }elseif ($cekMail->approval == 'Approve' ) {
            $credentials = ([
                'username' => $val,
                'password' => $password,
            ]);

            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
            // }

        } elseif ($cekMail == null) {
            return redirect()->back()->with(['success' => 'Tidak ada kredensial']);
        }
    }


    public function index()
    {
        $data['page_title'] = 'Daftar Pengguna';
        $data['breadcumb'] = 'Daftar Pengguna';
        $data['users'] = User::orderby('id', 'asc')->get();

        return view('users.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Tambah Pengguna';
        $data['breadcumb'] = 'Tambah Pengguna';
        $data['roles'] = Role::pluck('name')->all();
        $data['get_prov'] = Region::select(DB::raw('province'))
            ->groupBy('province')
            ->orderBy('province', 'asc')
            ->pluck('province', 'province');

        return view('users.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|unique:users,username|alpha_dash',
            'email'   => 'required|email|unique:users,email',
            'telepon' => 'required',
            'password' => 'required|min:8',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
            'province' => 'required',
            'district' => 'required',
            'subdistrict' => 'required',
            'area' => 'required',
            'post_code' => 'required',
            'alamat' => 'required',
        ]);



        $user = new User();
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->email = $validateData['email'];
        $user->telepon = $validateData['telepon'];
        $user->approval = 'Approve';

        $user->password = Hash::make($validateData['password']);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();
        $user->assignRole($validateData['role']);

        $cek = Region::where('province', $request->province)
            ->where('district', $request->district)
            ->where('subdistrict', $request->subdistrict)
            ->where('area', $request->area)
            ->where('post_code', $request->post_code)
            ->first();

        AlamatUser::create([
            'user_id' => $user->id,
            'region_id' => $cek->region_id,
            'alamat' => $validateData['alamat'],
        ]);

        return redirect()->route('users.index')->with(['success' => 'Pengguna Berhasil di Tambah']);
    }

    public function edit($id)
    {
        $data['page_title'] = 'Ubah Pengguna';
        $data['breadcumb'] = 'Ubah Pengguna';
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::pluck('name')->all();

        $data['get_prov'] = Region::select(DB::raw('province'))
            ->groupBy('province')
            ->orderBy('province', 'asc')
            ->pluck('province', 'province');

        return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validateData = $request->validate([
            'name'   => 'required|string|min:3',
            'username'   => 'required|alpha_dash|unique:users,username,' . $id,
            'email'   => 'required|unique:users,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'role' => 'required',
            'telepon' => 'required',
        ]);


        $user = User::findOrFail($id);
        $user->name = $validateData['name'];
        $user->username = $validateData['username'];
        $user->email = $validateData['email'];
        $user->telepon = $validateData['telepon'];

        if ($request->hasFile('avatar')) {
            // Delete Img
            if ($user->avatar) {
                $image_path = public_path('img/users/' . $user->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img/users/');
            $image->move($destinationPath, $name);
            $user->avatar = $name;
        }

        $user->save();

        $cek = Region::where('province', $request->province)
            ->where('district', $request->district)
            ->where('subdistrict', $request->subdistrict)
            ->where('area', $request->area)
            ->where('post_code', $request->post_code)
            ->first();

        if ($cek) {
            $alamat = AlamatUser::where('user_id', $id)->first();
            if ($alamat) {
                $alamat->region_id = $cek->region_id;
                $alamat->alamat = $request->alamat;
                $alamat->save();
            } else {
                $alamat = new AlamatUser();
                $alamat->user_id = $id;
                $alamat->region_id = $cek->region_id;
                $alamat->alamat = $request->alamat;
                $alamat->save();
            }
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($validateData['role']);

        return redirect()->route('users.index')->with(['success' => 'Pengguna Berhasil di ubah......']);
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            if ($user->avatar) {
                $image_path = public_path('img/users/' . $user->avatar); // Value is not URL but directory file path
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }


            $user->delete();

            AlamatUser::where('user_id', $id)->delete();
        });

        return redirect()->route('users.index')->with(['success' => 'Berhasil!']);
    }

    public function changePassword(Request $request)
    {
        $validateData = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if (Hash::check($validateData['password'], $user->password)) {
            $user->password = Hash::make($request->get('new_password'));
            $user->save();


            return redirect()->route('users.edit', Auth::user()->id)->with('success', 'Password berhasil di ubah!');
        } else {
            return redirect()->route('users.edit', Auth::user()->id)->with('failed', 'Password gagal di ubah...');
        }
    }
}
