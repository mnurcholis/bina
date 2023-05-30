<?php

use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryLogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuMasukController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\ListBukuController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('kabupaten', [RegionController::class, 'kabupaten'])->name('kabupaten');
Route::get('kecamatan', [RegionController::class, 'kecamatan'])->name('kecamatan');
Route::get('kelurahan', [RegionController::class, 'kelurahan'])->name('kelurahan');
Route::get('kode_pos', [RegionController::class, 'kode_pos'])->name('kode_pos');

Route::get('/login', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

Route::get('contact', [ShopController::class, 'contact'])->name('contact');
Route::post('sendMail', [ShopController::class, 'sendMail'])->name('sendMail');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register-store', [RegisterController::class, 'store'])->name('register-store');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');
Route::post('loginPostAdmin', [UserController::class, 'loginPostAdmin'])->name('loginPostAdmin');

Route::get('/', [ShopController::class, 'index'])->name('home');


Route::middleware('auth:web')->group(function () {
    Route::post('checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('update_checkout', [ShopController::class, 'update_checkout']);
    Route::post('update_bayaran', [ShopController::class, 'update_bayaran']);
    Route::get('cancel-checkout/{id}', [ShopController::class, 'cancel_checkout'])->name('cancel-checkout');
    Route::get('checkout-page/{id}', [ShopController::class, 'checkoutPage'])->name('checkout-page');
    Route::get('/cities/{province_id}', [CheckOngkirController::class, 'getCities']);
    Route::post('/ongkir', [CheckOngkirController::class, 'check_ongkir']);
    Route::post('status-paid', [ShopController::class, 'setPaid'])->name('status-paid');
    Route::get('transaksi', [ShopController::class, 'transaksi'])->name('transaksi');
    Route::get('daftar_pembayaran', [ShopController::class, 'daftar_pembayaran'])->name('daftar_pembayaran');
    Route::get('status-on-delivery/{id}', [ShopController::class, 'setOnDelivery'])->name('status-on-delivery');
    Route::get('status-received/{id}', [ShopController::class, 'setReceived'])->name('status-received');
    // Dashboard admin
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');
    // Dashboard umum

    Route::get('kategori-list', [KategoriController::class, 'index'])->name('kategori-list');
    Route::post('kategori-store', [KategoriController::class, 'store'])->name('kategori-store');
    Route::post('kategori-update/{id}', [KategoriController::class, 'update'])->name('kategori-update');
    Route::get('kategori-destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori-destroy');


    Route::get('buku-list', [BukuController::class, 'index'])->name('buku-list');
    Route::post('buku-store', [BukuController::class, 'store'])->name('buku-store');
    Route::get('buku-edit/{id}', [BukuController::class, 'edit'])->name('buku-edit');
    Route::post('buku-update/{id}', [BukuController::class, 'update'])->name('buku-update');
    Route::get('buku-destroy/{id}', [BukuController::class, 'destroy'])->name('buku-destroy');

    Route::get('data-buku-list', [ListBukuController::class, 'index'])->name('data-buku-list');
    Route::get('data-buku-masuk', [BukuMasukController::class, 'index'])->name('data-buku-masuk');
    Route::get('create-data-buku-masuk', [BukuMasukController::class, 'create'])->name('data-buku.create');
    Route::post('store-data-buku-masuk', [BukuMasukController::class, 'store'])->name('data-buku-masuk.store');
    Route::get('hapus-data-buku-masuk/{id}', [BukuMasukController::class, 'hapus'])->name('hapus-data-buku-masuk');

    Route::get('transaksi-list', [ShopController::class, 'transaksilist'])->name('transaksi-list');
    Route::get('data-penjualan', [ShopController::class, 'data_penjualan'])->name('data-penjualan');
    Route::post('cari_data_penjualan', [ShopController::class, 'cari_data_penjualan']);


    // Master Data
    Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    // Departement
    Route::resource('departements', DepartementController::class);

    // Users
    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');


    // History Log
    Route::resource('history-log', HistoryLogController::class)->except([
        'show', 'create', 'store', 'edit', 'update'
    ]);;

    // profilr edit
    Route::resource('profile', ProfileController::class)->except([
        'show', 'create', 'store'
    ]);

    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::patch('change-alamat-profile', [ProfileController::class, 'ubah_alamat'])->name('profile.change-alamat');
});
