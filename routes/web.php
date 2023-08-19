<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\KelasController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\Admin\UjianController;
use App\Http\Controllers\Home\BrevetController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Home\BerandaController;
use App\Http\Controllers\Home\InHouseController;

use App\Http\Controllers\Home\SeminarController;
use App\Http\Controllers\User\KatalogController;
use App\Http\Controllers\Admin\PemateriController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\JenisInstansiController;
use App\Http\Controllers\Admin\KerjasamaController;
use App\Http\Controllers\Home\UskpReviewController;
use App\Http\Controllers\Admin\SertifikatController;
use App\Http\Controllers\Admin\KeranjangProdukController;
use App\Http\Controllers\Admin\KeranjangProdukLama;
use App\Http\Controllers\Admin\KeranjangProdukOtomatisController;
use App\Http\Controllers\Admin\TandaTanganController;
use App\Http\Controllers\Admin\TenagaPendidikController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Pemateri\UjianController as PemateriUjianController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Pemateri\DashboardController as PemateriDashboardController;
use App\Models\MasterHeader;

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

Route::get('copy', function(){
    Artisan::call('storage:link');
    return redirect('/');
});

Route::post('payment/callback', [CheckoutController::class, 'midtransCallback']);
Route::get('payment/unfinish' , [CheckoutController::class, 'midtransUnfinished'])->name('midtransUnfinished');
Route::get('payment/error' , [CheckoutController::class, 'midtransError'])->name('midtransError');
Route::get('payment/success' , [CheckoutController::class, 'midtransSuccess'])->name('midtransSuccess');
Route::get('payment/pending' , [CheckoutController::class, 'midtransPending'])->name('midtransPending');

Route::get('/', [BerandaController::class, 'index'])->name('home-beranda');
Route::get('/check/dashboard', [BerandaController::class, 'dashboard_check'])->name('dashboard-check');

Route::get('galeri', [BerandaController::class, 'galeri'])->name('home-galeri');
Route::get('teams', [BerandaController::class, 'teams'])->name('home-teams');

Route::prefix('produk')->group(function(){
    Route::get('brevet', [BrevetController::class, 'index'])->name('home-brevet');
    Route::get('seminar', [SeminarController::class, 'index'])->name('home-seminar');
    Route::get('inhouse-training', [InHouseController::class, 'index'])->name('home-inhouse');
    Route::get('uskp-review', [UskpReviewController::class, 'index'])->name('home-uskp');
});

Route::get('login/{slug?}', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authLogin'])->name('login-auth');

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'authForgotPassword'])->name('forgot-password-auth');

Route::get('register/{slug?}', [AuthController::class, 'register'])->name('register');
Route::get('check-email', [AuthController::class, 'checkEmail'])->name('register-check-email');
Route::post('register', [AuthController::class, 'authRegister'])->name('register-auth');

Route::get('logout', [AuthController::class, 'authLogout'])->name('logut-auth');

Route::name('pemateri-')->middleware('pemateri')->group( function(){
    Route::get('pemateri', [PemateriDashboardController::class, 'index'])->name('dashboard');
    Route::get('bank-soal', [PemateriUjianController::class, 'bankSoal'])->name('bank-soal'); 
});

Route::name('admin-')->middleware('admin')->group( function(){
    Route::get('admin', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('chart-brevet', [DashboardController::class, 'chartBrevet'])->name('chart-brevet');
    Route::resource('keranjang-otomatis', KeranjangProdukOtomatisController::class);
    Route::post('keranjang-otomatis/manual/{id}', [KeranjangProdukOtomatisController::class, 'changeManual'])->name('midtrans-manual');
    Route::post('keranjang-otomatis/generate/link/{id}', [KeranjangProdukOtomatisController::class, 'generateLink'])->name('midtrans-generate-link');
    Route::get('keranjang-otomatis/get/link/pending/{id}', [KeranjangProdukOtomatisController::class, 'generateLink_Pending'])->name('midtrans-generate-link-pending');

    Route::prefix('master')->group(function () {
        Route::resource('ttd', TandaTanganController::class);
        Route::resource('master-header', HeaderController::class);
        Route::resource('master-pendidik', TenagaPendidikController::class);
        Route::post('master-pendidik/aktif/{id}', [TenagaPendidikController::class, 'aktif'])->name('aktif-pendidik');
        Route::resource('master-jenis-instansi', JenisInstansiController::class);

        Route::get('/users', [UserController::class, 'index'])->name('user');
        Route::delete('/deleteUser/{id}', [UserController::class, 'delete'])->name('delete-user');

        Route::get('/pemateri', [PemateriController::class, 'index'])->name('pemateri');
        Route::post('/createPemateri', [PemateriController::class, 'create'])->name('create-pemateri');
        Route::delete('/deletePemateri/{id}', [PemateriController::class, 'delete'])->name('delete-pemateri');

        Route::get('produk', [ProdukController::class, 'index'])->name('produk');
        Route::get('edit-produk/{id}', [ProdukController::class, 'edit'])->name('produk-edit');
        Route::post('store-produk', [ProdukController::class, 'store'])->name('produk-store');
        Route::delete('delete-produk/{id}', [ProdukController::class, 'destroy'])->name('produk-delete');

        // Route::put('isOnline/{id}', [ProdukController::class, 'isOnline'])->name('produk-isOnline');
        Route::post('add-sertifikat', [ProdukController::class, 'addSertifikatProduct'])->name('product-addSertifikat');
        Route::get('gallery', [GaleriController::class, 'index'])->name('gallery');
        Route::get('edit-gallery/{id}', [GaleriController::class, 'edit'])->name('galery-edit');
        Route::post('store-gallery', [GaleriController::class, 'store'])->name('galery-store');
        Route::delete('delete-gallery/{id}', [GaleriController::class, 'destroy'])->name('galery-delete');

        Route::get('materi', [MateriController::class, 'index'])->name('materi');
        Route::get('edit-materi/{id}', [MateriController::class, 'edit'])->name('materi-edit');
        Route::post('store-materi', [MateriController::class, 'store'])->name('materi-store');
        Route::delete('delete-materi/{id}', [MateriController::class, 'destroy'])->name('materi-delete');

        Route::get('sertifikat', [SertifikatController::class, 'index'])->name('sertifikat');
        Route::get('{id}/download-sertifikat', [SertifikatController::class, 'getSertifikat'])->name('unduh-sertifikat');
        Route::get('{id}/download-sertifikat-nilai', [SertifikatController::class, 'getSertifikatNilai'])->name('unduh-sertifikat-nilai');
        Route::get('/sertifikat/admin/{id}', [SertifikatController::class, 'sertifikatAdmin'])->name('sertifikat-admin');
        Route::post('/sertifikat/admin/ulang/{id}', [SertifikatController::class, 'sertifikatUlang'])->name('sertifikat-ulang-ttd');


        Route::get('instansi', [KerjasamaController::class, 'index'])->name('instansi');
        Route::post('instansi', [KerjasamaController::class, 'create'])->name('instansi-create');
        Route::post('instansi/update', [KerjasamaController::class, 'update'])->name('instansi-update');
        Route::get('instansi/show/{id}', [KerjasamaController::class, 'show'])->name('instansi-show');
        Route::delete('delete-instansi/{id}', [KerjasamaController::class, 'delete'])->name('instansi-delete');

        Route::get('diskon', [DiskonController::class, 'index'])->name('diskon');
        Route::post('diskon', [DiskonController::class, 'createDiskon'])->name('create-diskon');
        Route::get('toggle-active', [DiskonController::class, 'toggleActive'])->name('toggle-active');
    });

    Route::get('keranjang-produk', [KeranjangProdukController::class, 'index'])->name('keranjang-produk');
    Route::resource('keranjang-lama', KeranjangProdukLama::class);

    Route::get('keranjang-produk/detail/{id}', [KeranjangProdukController::class, 'detail'])->name('keranjang-produk-detail');
    Route::get('keranjang-produk/invoice/{id}', [KeranjangProdukController::class, 'invoiceBaru'])->name('keranjang-produk-invoice');

    
    Route::put('changeTransaksi', [KeranjangProdukController::class, 'changeTransaction'])->name('edit-transactions');
    Route::put('confirmTransaksi/{id}', [KeranjangProdukController::class, 'confirmTransaction'])->name('keranjang-produk-confirm');
    Route::put('deleteTransaksi', [KeranjangProdukController::class, 'destroy'])->name('keranjang-produk-destroy');

    Route::prefix('trash')->group(function(){
        Route::name('trash-')->group(function(){
            Route::get('trash-keranjang-produk', [TrashController::class, 'keranjangProduk'])->name('keranjang-produk');
            Route::get('trash-users', [TrashController::class, 'users'])->name('users');
        });
    });

    Route::prefix('ujian')->group(function(){
        Route::get('bank-soal', [UjianController::class, 'bankSoal'])->name('ujian-bank-soal');
        Route::post('store-soal', [UjianController::class, 'storeSoal'])->name('ujian-store-soal');
        Route::get('edit-soal/{id}', [UjianController::class, 'editSoal'])->name('ujian-edit-soal');
        Route::delete('{id}/delete-soal', [UjianController::class, 'destroySoal'])->name('ujian-destroy-soal');

        Route::get('akses-ujian', [UjianController::class, 'aksesUjian'])->name('ujian-akses-ujian');
        Route::put('tahap-pertama', [UjianController::class, 'tahapPertama'])->name('akses-tahap-pertama');
        Route::put('tahap-kedua', [UjianController::class, 'tahapKedua'])->name('akses-tahap-kedua');
        Route::put('tutup-akses', [UjianController::class, 'tutupAkses'])->name('tutup-akses-ujian');

        Route::get('hasil-peserta', [HasilController::class, 'index'])->name('hasil-peserta');
        Route::delete('{id}/delete-hasil-ujian', [HasilController::class, 'delete'])->name('hasil-ujian-delete');
    });

});

Route::middleware('user')->group(function() {
    Route::resource('checkout', CheckoutController::class);
    Route::post('/checkout/profile', [CheckoutController::class, 'profile_update'])
    ->name('checkout-profile');

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])
        ->name('user-dashboard');
    Route::get('/profil', [UserDashboardController::class, 'profile'])
        ->name('profil');
    Route::put('data-dapodik', [UserDashboardController::class, 'dataDapodik'])
        ->name('data-dapodik');
    Route::get('/hasil-ujian', [UserDashboardController::class, 'hasilUjian'])
        ->name('hasil-ujian');
    Route::put('/request-sertifikat', [SertifikatController::class, 'requestSertifikat'])
        ->name('request-sertifikat');
    Route::get('/sertifikat/user/{id}', [SertifikatController::class, 'SerfitikatUser'])
        ->name('sertifikat-user');

    Route::get('/print-sertifikat/{id}', [UserDashboardController::class, 'printSertifikat'])
        ->name('print-sertifikat');
    

    Route::get('/print-nilai/{id}', [UserDashboardController::class, 'printNilaiBaru'])
        ->name('print-nilai');
    Route::post('/upload-photo',[UserDashboardController::class, 'upload'])
        ->name('upload-photo');
    Route::get('/transaksi', [UserDashboardController::class, 'transaksi'])
        ->name('transaksi');
    Route::post('/transaksi/link/{id}', [UserDashboardController::class, 'bayar'])
        ->name('bayar');
    Route::get('/transaksi/cek/{id}', [UserDashboardController::class, 'cekTransaksi'])
        ->name('cek-midtrans');
    Route::get('/transaksi/invoice/{id}', [UserDashboardController::class, 'invoiceTransaksi'])
        ->name('transaksi-invoice');


    Route::get('invoice', [KeranjangProdukController::class, 'invoice'])
        ->name('keranjang-invoice');

    Route::post('voucher-verif', [KeranjangProdukController::class, 'voucherVerif'])
        ->name('voucher-verif');
    Route::get('potong-harga', [KeranjangProdukController::class, 'potongHarga'])
        ->name('potong-harga');

    Route::get('/BrevetAB', [KatalogController::class, 'katalogBrevet'])
        ->name('katalogBrevet');
    Route::get('/Seminar', [KatalogController::class, 'katalogSeminar'])
        ->name('katalogSeminar');
    Route::get('/InHouse', [KatalogController::class, 'katalogInHouse'])
        ->name('katalogInHouse');
    Route::get('/USKP', [KatalogController::class, 'katalogUSKP'])
        ->name('katalogUSKP');

    Route::get('/katalog-beli', [KatalogController::class, 'beli'])
        ->name('katalog_beli');
    Route::get('/informasi-beli', [KatalogController::class, 'informasi'])
        ->name('informasi');

    Route::get('/kelas',[KelasController::class, 'index'])
        ->name('kelas');
    Route::get('/list-materi',[KelasController::class, 'list'])
        ->name('list');
        Route::post('invoice', [KelasController::class, 'ujianUlang'])
        ->name('kelas-ujian-ulang');
    
        
    Route::get('/materi',[KelasController::class, 'materi'])
        ->name('materi');
    Route::get('/soal/{id}/{slug}',[KelasController::class, 'soal'])
        ->name('soal');
    Route::get('/soal-rules/{id}/{slug}',[KelasController::class, 'rules'])
        ->name('rules');
    Route::post('/soal/jawaban/user',[KelasController::class, 'jawaban'])
        ->name('jawaban');
    Route::post('/countdown', [KelasController::class, 'countdown_pre'])->name('countdown_pre');

    Route::post('/simpan-jawaban', [KelasController::class, 'simpanJawaban'])
        ->name('simpanJawaban');
    Route::get('/pembahasan/{materi_id}',[KelasController::class, 'pembahasan'])
        ->name('pembahasan');


});
