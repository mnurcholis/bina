<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use App\Models\Province;
use App\Models\Region;
use App\Models\User;

use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile', ['only' => 'index']);
        $this->middleware('permission:profile-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $data['page_title'] = 'Profil';
        $data['breadcumb'] = 'Profil ';
        $data['users'] = User::where('id', auth()->user()->id)->get();
        $data['roles'] = Role::pluck('name')->all();

        $data['get_prov'] = Region::select(DB::raw('province'))
            ->groupBy('province')
            ->orderBy('province', 'asc')
            ->pluck('province', 'province');

        return view('profile.index', $data);
    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Profile';
        $data['breadcumb'] = 'Edit Profile';
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::pluck('name')->all();
    }

    public function update(Request $request, $id)
    {
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
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($validateData['role']);

        return redirect()->route('profile.index')->with(['success' => 'Ubah Profile Berhasil!']);
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

            return redirect()->route('user.login', Auth::user()->id)->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->route('profile.index', Auth::user()->id)->with('failed', 'Password gagal diubah..');
        }
    }

    public function ubah_alamat(Request $request)
    {
        $id = $request->id;

        $cek = Region::where('province', $request->province)
            ->where('district', $request->district)
            ->where('subdistrict', $request->subdistrict)
            ->where('area', $request->area)
            ->where('post_code', $request->post_code)
            ->first();
        // dd($cek);

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

        return redirect()->route('profile.index')->with(['success' => 'Ubah Profile Berhasil!']);
    }
}
