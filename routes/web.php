<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlatformController;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    $data = DB::select("SELECT 
        n.id, 
        n.id_admin,
        n.judul, 
        SUBSTRING(n.deskripsi, 1, 75) as deskripsi, 
        DATE_FORMAT(n.created_at, '%d %M %Y') as tanggal,
        a.nama as nama
        FROM platforms n
        INNER JOIN admins a ON n.id_admin = a.id
        ORDER BY n.created_at DESC");
        
    $user = DB::select("SELECT *FROM users");    
    
    return view('frontend/index', ['tab' => 'dashboard', 'data' => $data, 'user' => $user]);
})->name('dashboard.index');

Route::resource('admin', AdminController::class);
Route::resource('platform', PlatformController::class);
