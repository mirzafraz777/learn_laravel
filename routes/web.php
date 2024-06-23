<?php

use Illuminate\Support\Facades\Route;
// use App\Models\Listing;
// use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GoogleSheetsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/transfer-data', [GoogleSheetsController::class, 'transferData']);
Route::get('/add-new-blog', [GoogleSheetsController::class, 'addNewBlog']);
Route::get('/update-publisher-sheet', [GoogleSheetsController::class, 'highAuthority']);
// Route::get('/clear-data', [GoogleSheetsController::class, 'clearSheetWithRange']);


Route::controller(ListingController::class)->group(function () {
    /////// Fetch All Listing   ///////
    Route::get('/', 'index');

    /////// Show Create Form  ///////
    Route::get('/listing/create', 'create');

    /////// Show Create Form  ///////
    Route::post('/listing', 'store');

    /////// Show Edit Listing  ///////
    Route::get('/listing/{listing}/edit', 'edit');

    /////// Update Listing  ///////
    Route::put('/listing/{listing}', 'update');

    /////// Delete Listing  ///////
    Route::delete('/listing/{listing}', 'delete');



    /////// Fetch Single Listing  ///////
    Route::get('/listing/{listing}', 'show');
});


Route::controller(UserController::class)->group(function () {

    /////// Show Register Form  ///////
    Route::get('/register', 'show')->name('regiter');

    /////// Submit Register Form  ///////
    Route::post('/register', 'store')->name('register');

    /////// Show Login Form  ///////
    Route::get('/login', 'showLogin')->name('login');

    /////// Submit Login Form  ///////
    Route::post('/login', 'submitLogin')->name('login');

    /////// Logout  ///////
    Route::post('/logout', 'logout')->name('logout');
});



Route::get('/products',[ProductController::class, 'index'])->name('productsAll');
Route::get('/products/create',[ProductController::class, 'create'])->name('productsCreate');
Route::post('/products',[ProductController::class, 'store'])->name('productsStore');
Route::get('/products/{id}/edit',[ProductController::class, 'edit'])->name('productsEdit');
Route::put('/products/{id}',[ProductController::class, 'update'])->name('productsUpdate');
Route::delete('/products/{id}',[ProductController::class, 'delete'])->name('productsDelete');
Route::get('/products/{id}',[ProductController::class, 'show'])->name('productsShow');







// Route Models Binding
// Route::get('/listing/{listing}', function(Listing $listing){
//     return view('single-listing',[
//         'listing'=>$listing
//     ]);
// });

// Route::get('/hello', function (){
//     $newHeaders = [
//         'Content-Type'=>'text/plain',
//         'foo'=>'bar'
//     ];
//     return response('<h2>Hello World</h2>',200,$newHeaders);
// });

// Route::get('/posts/{id}', function ($id){
//     // dd($id);
//     return response('Post ID: '. $id);
// })->where('id', '[0-9]+');

// Route::get('/serach', function (Request $request) {
//     // dd($request);
//     return($request->price.' - '. $request->color);
// });
